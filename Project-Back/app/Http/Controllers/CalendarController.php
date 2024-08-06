<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class CalendarController extends Controller
{
    public function parseIcsFromUrl()
    {
        $icsUrl = 'https://calendar.google.com/calendar/ical/aren.avagyan100%40gmail.com/private-7b88b771c9f7c46dbf531c0832983d67/basic.ics';
        $icsData = $this->getIcsFromUrl($icsUrl);

        $events = $this->extractEvents($icsData);
        $events = $this->filterEventsForNextWeek($events);
        $mergedIntervals = $this->mergeIntervals($events);
        $totalSummaryTime = $this->calculateTotalTime($mergedIntervals);

        return response()->json(['total_summary_time' => $totalSummaryTime]);
    }

    /**
     * Get ICS data from the given URL.
     *
     * @param string $url
     * @return string
     */
    private function getIcsFromUrl($url)
    {
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->body();
        } else {
            // Handle the error appropriately
            abort(500, 'Unable to fetch ICS data');
        }
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
     * Filter events to only include those in the next week.
     *
     * @param array $events
     * @return array
     */
    private function filterEventsForNextWeek($events)
    {
        $now = Carbon::now();
        $oneWeekLater = $now->copy()->addWeek();

        return array_filter($events, function ($event) use ($now, $oneWeekLater) {
            return $event['start']->between($now, $oneWeekLater);
        });
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
