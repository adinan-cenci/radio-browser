<?php 
namespace AdinanCenci\RadioBrowser;

use \AdinanCenci\SimpleRequest\Request;

class RadioBrowser 
{
    protected $server = null;

    public function __construct($server = 'https://de1.api.radio-browser.info/') 
    {
        if ($server == false) {
            $server = self::pickAServer();
        }

        $this->server = $server;
    }

    public function getCountries($filter = '', $order = 'name', $reverse = false, $hideBroken = false) 
    {
        return $this->getInfo($this->server.'json/countries/'.$filter, $order, $reverse, $hideBroken);
    }

    public function getCountryCodes($filter = '', $order = 'name', $reverse = false, $hideBroken = false) 
    {
        return $this->getInfo($this->server.'json/countrycodes/'.$filter, $order, $reverse, $hideBroken);
    }

    public function getCodecs($filter = '', $order = 'name', $reverse = false, $hideBroken = false) 
    {
        return $this->getInfo($this->server.'json/codecs/'.$filter, $order, $reverse, $hideBroken);
    }

    public function getStates($filter = '', $order = 'name', $reverse = false, $hideBroken = false, $country = null) 
    {
        $url       = $this->server.'json/states/<country>/'.$filter;
        $variables = [
            'order'      => $order, 
            'reverse'    => (string) $reverse, 
            'hidebroken' => (string) $hideBroken, 
            'country'    => $country
        ];
        
        return $this->request($url, $variables);
    }

    public function getLanguages($filter = '', $order = 'name', $reverse = false, $hideBroken = false) 
    {
        return $this->getInfo($this->server.'json/languages/'.$filter, $order, $reverse, $hideBroken);
    }

    public function getTags($filter = '', $order = 'name', $reverse = false, $hideBroken = false) 
    {
        return $this->getInfo($this->server.'json/tags/'.$filter, $order, $reverse, $hideBroken);
    }

    //------------------------------------

    public function getStationsByUuid($uuid, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/byuuid/'.$uuid, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByName($name, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/byname/'.$name, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactName($name, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/bynameexact/'.$name, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByCodec($codec, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/bycodec/'.$codec, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactCodec($codec, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/bycodecexact/'.$codec, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByCountry($country, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/bycountry/'.$country, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactCountry($country, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/bycountryexact/'.$country, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByState($state, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/bystate/'.$state, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactState($state, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/bystateexact/'.$state, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByLanguage($language, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/bylanguage/'.$language, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactLanguage($language, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/bylanguageexact/'.$language, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByTag($tag, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        $tag = rawurlencode( trim($tag, '#') );
        return $this->getStationsBy($this->server.'json/stations/bytag/'.$tag, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactTag($tag, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        $tag = rawurlencode( trim($tag, '#') );
        return $this->getStationsBy($this->server.'json/stations/bytagexact/'.$tag, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStations($order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.'json/stations/', $order, $reverse, $hideBroken, $offset, $limit);
    }

    //------------------------------------

    public function getStationCheckResults($stationUuid = '', $lastCheckUuid = null, $seconds = 0) 
    {
        $url = $this->server.'json/checks/'.$stationUuid;

        $variables = [
            'lastcheckuuid' => $lastCheckUuid, 
            'seconds'       => $seconds
        ];

        return $this->request($url, $variables);
    }

    public function getStationClicks($stationUuid = '', $lastClickUuid = null, $seconds = 0) 
    {
        $url = $this->server.'json/clicks/'.$stationUuid;

        $variables = [
            'lastclickuuid' => $lastClickUuid, 
            'seconds'       => $seconds
        ];

        return $this->request($url, $variables);
    }

    public function clickStation($stationUuid) 
    {
        $url = $this->server.'json/url/'.$stationUuid;
        return $this->request($url);
    }

    //------------------------------------

    protected function getInfo($url, $order = 'name', $reverse = false, $hideBroken = false) 
    {
        $variables = [
            'order'      => $order, 
            'reverse'    => self::stringBoolean($reverse), 
            'hidebroken' => self::stringBoolean($hideBroken)
        ];

        return $this->request($url, $variables);
    }    

    protected function getStationsBy($url, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        $variables = [
            'order'      => $order, 
            'reverse'    => self::stringBoolean($reverse), 
            'hidebroken' => self::stringBoolean($hideBroken), 
            'offset'     => $offset, 
            'limit'      => $limit
        ];

        return $this->request($url, $variables);
    }

    protected function request($url, $fields = null) 
    {
        $r = new Request($url);
        if ($fields) {
            $r->fields($fields);
        }
        $response = $r->request();

        if ($response->code != 200) {
            throw new \Exception('Error requesting "'.$response->url.'", code: '.$response->code, 1);
        }

        return $response->body;
    }

    //------------------------------------

    public static function getServersIps() 
    {
        $ips     = [];
        $records = dns_get_record('all.api.radio-browser.info', \DNS_A);

        foreach ($records as $r) {
            $ips[] = $r['ip'];
        }

        return $ips;
    }

    // pick a random server
    public static function pickAServer() 
    {
        $ips    = self::getServersIps();
        $count  = count($ips);
        $chosen = rand(0, $count - 1);
        return gethostbyaddr($ips[$chosen]);
    }

    //------------------------------------

    protected static function stringBoolean($value) 
    {
        if ($value === 'false' || $value == false) {
            return 'false';
        }

        return 'true';
    }
}
