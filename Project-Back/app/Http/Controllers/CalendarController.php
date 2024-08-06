<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{

    public function parseIcs()
    {

        $icsData = 'BEGIN:VCALENDAR
        PRODID:-//Google Inc//Google Calendar 70.9054//EN
        VERSION:2.0
        CALSCALE:GREGORIAN
        METHOD:PUBLISH
        X-WR-CALNAME:aren.avagyan100@gmail.com
        X-WR-TIMEZONE:Asia/Yerevan
        BEGIN:VEVENT
        DTSTART:20240806T113000Z
        DTEND:20240806T123000Z
        DTSTAMP:20240806T110943Z
        UID:2ck5sqnh613m82nr63t0fd7vvi@google.com
        CREATED:20240806T110546Z
        LAST-MODIFIED:20240806T110546Z
        SEQUENCE:0
        STATUS:CONFIRMED
        SUMMARY:Task 1
        TRANSP:OPAQUE
        END:VEVENT
        BEGIN:VEVENT
        DTSTART:20240806T121000Z
        DTEND:20240806T131000Z
        DTSTAMP:20240806T110943Z
        UID:7d9fh0jgirhlip6de3033a8n7f@google.com
        CREATED:20240806T110604Z
        DESCRIPTION:Task 2
        LAST-MODIFIED:20240806T110655Z
        SEQUENCE:0
        STATUS:CONFIRMED
        SUMMARY:Task 2
        TRANSP:OPAQUE
        END:VEVENT
        END:VCALENDAR';


        $events = $this->extractEvents($icsData);
        $mergedIntervals = $this->mergeIntervals($events);
        $totalSummaryTime = $this->calculateTotalTime($mergedIntervals);


        return response()->json(['total_summary_time' => $totalSummaryTime]);
    }

    /**
     * Extract events from the ICS data.
     *
     * @param string $icsData
     * @return array
     */
    private function extractEvents($icsData)
    {
        $events = [];
        $lines = explode("\n", $icsData);
        $currentEvent = [];

        foreach ($lines as $line) {
            $line = trim($line);

            if (strpos($line, 'BEGIN:VEVENT') === 0) {
                $currentEvent = [];
            } elseif (strpos($line, 'END:VEVENT') === 0) {
                if (isset($currentEvent['DTSTART']) && isset($currentEvent['DTEND'])) {
                    $events[] = [
                        'start' => $this->parseDateTime($currentEvent['DTSTART']),
                        'end' => $this->parseDateTime($currentEvent['DTEND']),
                    ];
                }
                $currentEvent = [];
            } elseif (!empty($line)) {
                list($key, $value) = explode(':', $line, 2);
                $currentEvent[$key] = $value;
            }
        }

        return $events;
    }

    /**
     * Convert ICS datetime format to a Carbon instance.
     *
     * @param string $icsDate
     * @return \Carbon\Carbon
     */
    private function parseDateTime($icsDate)
    {
        return Carbon::createFromFormat('Ymd\THis\Z', $icsDate, 'UTC');
    }

    /**
     * Merge overlapping intervals and return the result.
     *
     * @param array $events
     * @return array
     */
    private function mergeIntervals($events)
    {

        usort($events, function ($a, $b) {
            return $a['start']->lt($b['start']) ? -1 : 1;
        });

        $mergedIntervals = [];
        $currentStart = $events[0]['start'];
        $currentEnd = $events[0]['end'];

        foreach ($events as $event) {
            if ($event['start']->lte($currentEnd)) {
                $currentEnd = $currentEnd->max($event['end']);
            } else {
                $mergedIntervals[] = [
                    'start' => $currentStart,
                    'end' => $currentEnd,
                ];
                $currentStart = $event['start'];
                $currentEnd = $event['end'];
            }
        }

        $mergedIntervals[] = [
            'start' => $currentStart,
            'end' => $currentEnd,
        ];

        return $mergedIntervals;
    }

    /**
     * Calculate the total summary time from merged intervals.
     *
     * @param array $mergedIntervals
     * @return int
     */
    private function calculateTotalTime($mergedIntervals)
    {
        $totalMinutes = 0;

        foreach ($mergedIntervals as $interval) {
            $duration = $interval['start']->diffInMinutes($interval['end']);
            $totalMinutes += $duration;
        }

        return $totalMinutes;
    }
}
