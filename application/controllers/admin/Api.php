<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->logged !== true) {
            redirect('admin/auth');
        }
        $this->load->model('Rute_model');
        $this->load->model('HotspotModel');
    }

    public function data($jenis = 'jalur', $type = 'point', $id = '')
    {
        header('Content-Type: application/json');
        $response = [];
        if ($jenis == 'jalur') {
            $getjalur = $this->Rute_model->get_jalur();
            foreach ($getjalur->result() as $row) {
                $data = null;
                $data['id_jalur'] = $row->id_jalur;
                $data['kd_jalur'] = $row->kd_jalur;
                $data['jalur'] = $row->jalur;
                $data['geojson'] = $row->geojson;
                $data['warna'] = $row->warna;
                $data['marker'] = ($row->marker == '') ? ('assets/icons/marker.png') : (str_replace("dl=0","raw=1",$row->linkmarker));;
                $data['linkgeojson'] = $row->linkgeojson;
                $response[] = $data;
            }
            echo "var dataJalur=" . json_encode($response, JSON_PRETTY_PRINT);
        }
        if ($jenis == 'kategoritikor') { 
            $kategoritikor = $this->Rute_model->get_jalur();
            foreach ($kategoritikor->result() as $row) {
                $data = null;
                $data['id_jalur'] = $row->id_jalur;
                $data['jalur'] = $row->jalur;
                $data['warna'] = $row->warna;
                //$data['marker'] = ($row->marker == '') ? ('assets/icons/marker.png') : (str_replace("dl=0","raw=1",$row->linkmarker));
                $response[] = $data;
            }
            echo "var datakategoritikor=" . json_encode($response, JSON_PRETTY_PRINT);
        }
        // if ($jenis == 'kategoritikor') {
        //     if ($id != '') {
        //         $this->db->where('a.id_jalur', $id);
        //     }
        //     $kategoritikor = $this->HotspotModel->get();
        //     foreach ($kategoritikor->result() as $row) {
        //         $data = null;
        //         $data['id_jalur'] = $row->id_jalur;
        //         $data['jalur'] = $row->jalur;
        //         $data['stop'] = $row->stop;
        //         $data['latitude'] = $row->latitude;
        //         $data['longitude'] = $row->longitude;
        //         $data['marker'] = ($row->marker == '') ? ('assets/icons/marker.png') : ('assets/unggah/marker/' . $row->marker);
        //         $response[] = $data;
        //     }
        //     echo "var datakategoritikor=" . json_encode($response, JSON_PRETTY_PRINT);
        elseif ($jenis == 'tikor') {
            if ($type == 'point') {
                if ($id != '') {
                    $this->db->where('a.id_jalur', $id);
                }
                $getTikor = $this->HotspotModel->get();

                foreach ($getTikor->result() as $row) {
                    $data = null;
                    $data['type'] = "Feature";
                    $data['properties'] = [
                        "jalur" => $row->jalur,
                        "stop" => $row->stop,
                        "warna" => $row->warna,
                        // "tanggal" => $row->tanggal,
                        //"marker" => ($row->marker == '') ? ('assets/icons/marker.png') : (str_replace("dl=0","raw=1",$row->linkmarker)),
                        "popUp" => "Jalur : " . $row->jalur . "<br>Pemberhentian : " . $row->stop
                    ];
                    $data['geometry'] = [
                        "type" => "Point",
                        "coordinates" => [$row->longitude, $row->latitude]
                    ];
                    $response[] = $data;
                }
                echo json_encode($response, JSON_PRETTY_PRINT);
            }
        }
        // if($jenis=='kategorihotspot'){
        // 	$getKategorihotspot=$this->KategorihotspotModel->get();
        // 	foreach ($getKategorihotspot->result() as $row) {
        // 		$data=null;
        // 		$data['id_kategori_hotspot']=$row->id_kategori_hotspot;
        // 		$data['nm_kategori_hotspot']=$row->nm_kategori_hotspot;
        // 		$data['icon']=($row->marker=='')?assets('icons/marker.png'):assets('unggah/marker/'.$row->marker);
        // 		$response[]=$data;
        // 	}
        // 	echo "var dataKategorihotspot=".json_encode($response,JSON_PRETTY_PRINT);
        // }
        // elseif($jenis=='hotspot'){
        // 	if($type=='point'){
        // 		if($id!=''){
        // 			$this->db->where('a.id_kategori_hotspot',$id);
        // 		}
        // 		$getHotspot=$this->HotspotModel->get();
        // 		foreach ($getHotspot->result() as $row) {
        // 			$data=null;
        // 			$data['type']="Feature";
        // 			$data['properties']=[
        // 										"name"=>$row->lokasi,
        // 										"lokasi"=>$row->lokasi.' Kec. '.$row->nm_kecamatan,
        // 										"keterangan"=>$row->keterangan,
        // 										"tanggal"=>$row->tanggal,
        // 										"icon"=>($row->marker=='')?assets('icons/marker.png'):assets('unggah/marker/'.$row->marker),
        // 										"popUp"=>"Lokasi : ".$row->lokasi.", Kec. ".$row->nm_kecamatan."<br>Keterangan : ".$row->keterangan."<br>Tanggal : ".$row->tanggal
        // 										];
        // 			$data['geometry']=[
        // 										"type" => "Point",
        // 										"coordinates" => [$row->lng,$row->lat ] 
        // 										];	

        // 			$response[]=$data;
        // 		}
        // 		echo json_encode($response,JSON_PRETTY_PRINT);	
        // 	}
        // 	if($type=='varpoint'){
        // 		if($id!=''){
        // 			$this->db->where('a.id_kategori_hotspot',$id);
        // 		}
        // 		$getHotspot=$this->HotspotModel->get();
        // 		foreach ($getHotspot->result() as $row) {
        // 			$data=null;
        // 			$data['type']="Feature";
        // 			$data['properties']=[
        // 										"name"=>$row->lokasi,
        // 										"lokasi"=>$row->lokasi.' Kec. '.$row->nm_kecamatan,
        // 										"keterangan"=>$row->keterangan,
        // 										"tanggal"=>$row->tanggal,
        // 										"icon"=>($row->marker=='')?assets('icons/marker.png'):assets('unggah/marker/'.$row->marker),
        // 										"popUp"=>"Lokasi : ".$row->lokasi.", Kec. ".$row->nm_kecamatan."<br>Keterangan : ".$row->keterangan."<br>Tanggal : ".$row->tanggal
        // 										];
        // 			$data['geometry']=[
        // 										"type" => "Point",
        // 										"coordinates" => [$row->lng,$row->lat ] 
        // 										];	

        // 			$response[]=$data;
        // 		}
        // 		echo 'hotspotPoint ='.json_encode($response,JSON_PRETTY_PRINT);	
        // 	}
        // 	elseif($type=="polygon"){
        // 		$getHotspot=$this->HotspotModel->get();
        // 		$polygon=null;
        // 		foreach ($getHotspot->result() as $row) {
        // 			if($row->polygon!=NULL){
        // 				$polygon[]=$row->polygon;
        // 			}
        // 		}
        // 		echo "var latlngs=[".implode(',', $polygon)."];";
        // 	}

        // }

    }
}
