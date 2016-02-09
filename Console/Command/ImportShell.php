<?php

class ImportShell extends AppShell {

    public $uses = array('Point');

    public function main() {
        /*
         * from https://github.com/chihchun/tainaneq26waterstation/blob/master/stations.kml
         */
        $xml = simplexml_load_file(__DIR__ . '/data/stations.kml');
        foreach ($xml->Folder->Placemark AS $p) {
            if (isset($p->Point)) {
                $data = array(
                    'member_id' => '0',
                    'status' => '1',
                    'comment' => '來源： http://www.water.gov.tw/06news/news_b_main2.asp?no_g=6226',
                );
                $parts = explode('<br>', (string) $p->description);
                $pos = strrpos($parts[1], '-');
                if (false === $pos) {
                    $data['address'] = $parts[1];
                } else {
                    $data['address'] = substr($parts[1], 0, $pos);
                }
                $data['name'] = (string) $p->name;

                $pos = strrpos($parts[2], ' ');
                $data['phone'] = substr($parts[2], $pos + 1);
                $data['contact'] = substr($parts[2], 0, $pos);
                $parts = explode(',', (string) $p->Point->coordinates);
                $data['longitude'] = $parts[0];
                $data['latitude'] = $parts[1];
                $this->Point->create();
                if ($this->Point->save(array('Point' => $data))) {
                    $savedId = $this->Point->getInsertID();
                    $this->Point->PointLog->create();
                    $this->Point->PointLog->save(array('PointLog' => array(
                            'Point_id' => $savedId,
                            'status' => '1',
                    )));
                }
            }
        }
    }

}
