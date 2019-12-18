<?php
/**
 * Created by : PhpStorm
 * User: zhang
 * Date: 2019/12/18
 * Time: 16:49
 */

namespace lib;


class Earth
{
    /**
     * 计算两点之间的距离
     * @param $lat1
     * @param $lng1
     * @param $lat2
     * @param $lng2
     * @return float|int
     */
    public function GetDistance($lat1, $lng1, $lat2, $lng2)
    {
        $EARTH_RADIUS = 6378.137;
        $radLat1 = $this->rad($lat1);
        $radLat2 = $this->rad($lat2);
        $a = $radLat1 - $radLat2;
        $b = $this->rad($lng1) - $this->rad($lng2);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s = $s * $EARTH_RADIUS;
        $s = round($s * 10000) / 10000;
        return $s;
    }

    /**
     * @param $d
     * @return float
     */
    private function rad($d)
    {
        return $d * M_PI / 180.0;
    }
}