<?php 
namespace AdinanCenci\RadioBrowser;

use \AdinanCenci\SimpleRequest\Request;

class RadioBrowser 
{
    protected $server = null;
    protected $format = 'json';

    public function __construct($server = 'https://de1.api.radio-browser.info/', $format = 'json') 
    {
        if ($server == false) {
            $server = self::pickAServer();
        }

        $this->server = $server;

        $this->format = $format;
    }

    public function getCountries($filter = '', $order = 'name', $reverse = false, $hideBroken = false) 
    {
        return $this->standardRequest($this->server.$this->format.'/countries/'.$filter, $order, $reverse, $hideBroken);
    }

    public function getCountryCodes($filter = '', $order = 'name', $reverse = false, $hideBroken = false) 
    {
        return $this->standardRequest($this->server.$this->format.'/countrycodes/'.$filter, $order, $reverse, $hideBroken);
    }

    public function getCodecs($filter = '', $order = 'name', $reverse = false, $hideBroken = false) 
    {
        return $this->standardRequest($this->server.$this->format.'/codecs/'.$filter, $order, $reverse, $hideBroken);
    }

    public function getStates($filter = '', $country = null, $order = 'name', $reverse = false, $hideBroken = false) 
    {
        $url = $country ?
            $this->server.$this->format.'/states/'.$country.'/'.$filter : 
            $this->server.$this->format.'/states/'.$filter;

        $variables = [
            'order'      => $order, 
            'reverse'    => (string) $reverse, 
            'hidebroken' => (string) $hideBroken
        ];
        
        return $this->fetchBody($url, $variables);
    }

    public function getLanguages($filter = '', $order = 'name', $reverse = false, $hideBroken = false) 
    {
        return $this->standardRequest($this->server.$this->format.'/languages/'.$filter, $order, $reverse, $hideBroken);
    }

    public function getTags($filter = '', $order = 'name', $reverse = false, $hideBroken = false) 
    {
        return $this->standardRequest($this->server.$this->format.'/tags/'.$filter, $order, $reverse, $hideBroken);
    }

    //------------------------------------

    public function getStationsByUuid($uuids) 
    {
        $parameters['uuids'] = is_array($uuids) ? implode(',', $uuids) : $uuids;

        $url = $this->server.$this->format.'/stations/byuuid';

        return $this->fetchBody($url, $parameters);
    }

    public function getStationsByUrl($url) 
    {
        $parameters['url'] = $url;

        $url = $this->server.$this->format.'/stations/byurl';

        return $this->fetchBody($url, $parameters);
    }

    public function getStationsByName($name, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/byname/'.$name, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactName($name, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/bynameexact/'.$name, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByCodec($codec, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/bycodec/'.$codec, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactCodec($codec, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/bycodecexact/'.$codec, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByCountry($country, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/bycountry/'.$country, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactCountry($country, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/bycountryexact/'.$country, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByState($state, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/bystate/'.$state, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactState($state, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/bystateexact/'.$state, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByLanguage($language, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/bylanguage/'.$language, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactLanguage($language, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/bylanguageexact/'.$language, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByTag($tag, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        $tag = rawurlencode( trim($tag, '#') );
        return $this->getStationsBy($this->server.$this->format.'/stations/bytag/'.$tag, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function getStationsByExactTag($tag, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        $tag = rawurlencode( trim($tag, '#') );
        return $this->getStationsBy($this->server.$this->format.'/stations/bytagexact/'.$tag, $order, $reverse, $hideBroken, $offset, $limit);
    }

    public function searchStation($searchTerms) 
    {
        $defaultParameters = [
            'name'          => null, 
            'nameExact'     => false, 
            'country'       => null, 
            'countryExact'  => false, 
            'countrycode'   => null, 
            'state'         => null, 
            'stateExact'    => false, 
            'language'      => null, 
            'languageExact' => false, 
            'tag'           => null, 
            'tagExact'      => false, 
            'tagList'       => null, 
            'codec'         => null, 
            'bitrateMin'    => 0, 
            'bitrateMax'    => 1000000, 
            'order'         => 'name', 
            'reverse'       => false, 
            'offset'        => 0, 
            'limit'         => 100000
        ];

        $parameters = array_merge($defaultParameters, $searchTerms);

        $parameters['nameExact']    = self::stringBoolean($parameters['nameExact']);
        $parameters['countryExact'] = self::stringBoolean($parameters['countryExact']);
        $parameters['stateExact']   = self::stringBoolean($parameters['stateExact']);
        $parameters['languageExact']= self::stringBoolean($parameters['languageExact']);
        $parameters['tagExact']     = self::stringBoolean($parameters['tagExact']);
        $parameters['reverse']      = self::stringBoolean($parameters['reverse']);

        $url = $this->server.$this->format.'/stations/search';

        return $this->fetchBody($url, $parameters);
    }

    # all stations
    public function getStations($order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000) 
    {
        return $this->getStationsBy($this->server.$this->format.'/stations/', $order, $reverse, $hideBroken, $offset, $limit);
    }

    //------------------------------------

    public function getStationCheckResults($stationUuid = '', $lastCheckUuid = null, $seconds = 0) 
    {
        $url = $this->server.$this->format.'/checks/'.$stationUuid;

        $variables = [
            'lastcheckuuid' => $lastCheckUuid, 
            'seconds'       => $seconds
        ];

        return $this->fetchBody($url, $variables);
    }

    public function getStationClicks($stationUuid = '', $lastClickUuid = null, $seconds = 0) 
    {
        $url = $this->server.$this->format.'/clicks/'.$stationUuid;

        $variables = [
            'lastclickuuid' => $lastClickUuid, 
            'seconds'       => $seconds
        ];

        return $this->fetchBody($url, $variables);
    }

    public function clickStation($stationUuid) 
    {
        $url = $this->server.$this->format.'/url/'.$stationUuid;
        return $this->fetchBody($url);
    }

    public function voteStation($stationUuid) 
    {
        $url = $this->server.$this->format.'/vote/'.$stationUuid;
        return $this->fetchBody($url);
    }

    // stationsByClicks
    // topclick/rowcount

    // stationsByVotes
    // topvote/rowcount

    // stationsByRecentClicks
    // lastclick/rowcount

    // stationsByLastChange
    // lastchange/rowcount

    // stationsOldVersion
    // changed/stationuuid

    // stationsImprovable
    // improvable/rowcount

    // stationsBroken
    // broken/rowcount

    // addStation
    // add

    // server/stats

    // server mirrors
    // servers

    // server config
    // config

    // metrics
    // metrics

    //------------------------------------

    // Most api calls support the exact same 3 parameters
    protected function standardRequest($url, $order = 'name', $reverse = false, $hideBroken = false) 
    {
        $variables = [
            'order'      => $order, 
            'reverse'    => self::stringBoolean($reverse), 
            'hidebroken' => self::stringBoolean($hideBroken)
        ];

        return $this->fetchBody($url, $variables);
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

        return $this->fetchBody($url, $variables);
    }

    protected function fetch($url, $fields = array()) 
    {
        $r = new Request($url);
        $r->fields($fields);

        $response = $r->request();

        if ($response->code != 200) {
            throw new \Exception('Error requesting "'.$response->url.'", code: '.$response->code, 1);
        }

        return $response;
    }

    protected function fetchBody($url, $fields = array()) 
    {
        $response = $this->fetch($url, $fields);
        return $response->body;
    }

    //------------------------------------

    public static function getDnsRecords() 
    {
        return dns_get_record('all.api.radio-browser.info', \DNS_A);
    }

    public static function getServerIps() 
    {
        $ips     = [];
        $records = self::getDnsRecords();

        foreach ($records as $r) {
            $ips[] = $r['ip'];
        }

        return $ips;
    }

    public static function getServers() 
    {
        $servers = [];

        foreach (self::getServersIps() as $ip) {
            $servers[] = gethostbyaddr($ip);
        }

        return $servers;
    }

    // pick a random server
    public static function pickAServer() 
    {
        $ips    = self::getServers();
        $count  = count($ips);
        $chosen = rand(0, $count - 1);
        return $ips[$chosen];
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
