<?php

header('Content-Type: application/json');
include('../_cms/autoload.php');
$app = include_once('YouTube-Downloader/bootstrap.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;


$videoInfo = new VideoInfo();

if(isset($datos->videoid)){
	if ($this->get('no_stream_map_found', false) === true) {
		$jsonFinal->msg = 'No se encontró flujo de formato codificado.. Esto es lo que obtuvimos:';
		$jsonFinal->data = $this->get('no_stream_map_found_dump'); 
	} else {		
		if ($this->get('show_debug1', false) === true) {
			# $this->get('debug1');
		}
		
		if ($this->get('show_debug2', false) === true) {
			# debug2_expires
			# Estos enlaces caducarán en
			# echo $this->get('debug2_expires')
			# El servidor estaba en la dirección IP
			# $this->get('debug2_ip'); que es un $this->get('debug2ipbits'); poco dirección IP.
			# Tenga en cuenta que cuando se utilizan direcciones IP de 8 bits, los enlaces de descarga pueden fallar.
		}
		
		# $this->get('video_title');
		$videoInfo->title = $this->get('video_title');

		if ($this->get('show_thumbnail') === true) {
			$videoInfo->thumbnail = "https://i.ytimg.com/vi/{$_GET['videoid']}/hqdefault.jpg";
		}
		
		
		if ($this->get('showMP3Download', false) === true) {
			# Convert and Download to .mp3
			# $this->get('mp3_download_quality');
			# $this->get('mp3_download_url');
			# Convert and Download
			$videoInfo->mp3_download_url = url_site.'/api/YouTube-Downloader/'.$this->get('mp3_download_url');
			$videoInfo->mp3_download_quality = $this->get('mp3_download_quality');
		}

		$videos = array();
		foreach($this->get('streams', []) as $format) {
			if($format['size'] !== '0B'){
				if ($format['show_direct_url'] === true) {
					$item = new stdClass();
					$item->label = $format['quality'].' - YouTube';
					$item->type = $format['type'];
					$item->size = $format['size'];
					$item->file = $format['direct_url'];
					$videos[] = $item;
				}
				
				if ($format['show_proxy_url'] === true) {
					$item = new stdClass();
					$item->label = $format['quality'].' - deMedallo';
					$item->type = $format['type'];
					$item->size = $format['size'];
					$item->file = url_site.'/api/YouTube-Downloader/'.$format['proxy_url'];
					$videos[] = $item;
				}
			}
		} 
		# $videos = array_reverse($videos);
		$videoInfo->videos = $videos;
		$videoInfo->total_videos = count($videos);
		
		$audios = array();
		foreach($this->get('formats', []) as $format) {
			if($format['size'] !== '0B'){
				if ($format['show_direct_url'] === true) {
					$item = new stdClass();
					$item->label = $format['quality'].' - YouTube';
					$item->type = $format['type'];
					$item->size = $format['size'];
					$item->file = $format['direct_url'];
					$audios[] = $item;
				}
				
				if ($format['show_proxy_url'] === true) {
					$item = new stdClass();
					$item->label = $format['quality'].' - deMedallo';
					$item->type = $format['type'];
					$item->size = $format['size'];
					$item->file = url_site.'/api/YouTube-Downloader/'.$format['proxy_url'];
					$audios[] = $item;
				}
			}
		} 
		# $audios = array_reverse($audios);
		$videoInfo->audios = $audios;
		$videoInfo->total_audios = count($audios);
		
		$tags = get_meta_tags('https://www.youtube.com/watch?v=' . $datos->videoid);
		$videoInfo->videoid = $datos->videoid;
		$videoInfo->tags = $tags;
		
		if(isset($tags['twitter:description'])){
			$videoInfo->description = $tags['twitter:description'];
		}
		
		$jsonFinal->error = false;
		$jsonFinal->msg = 'Videoc cargado con exito.';
	}
}
else{ $jsonFinal->msg = "No existen datos validos."; }

$jsonFinal->data = $videoInfo;

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);


$total_videos = 0;
foreach($this->get('formats', []) as $format) {
	if($format['size'] !== '0B'){
		$total_videos = $total_videos + 1;
	}
}

$total_audios = 0;
foreach($this->get('formats', []) as $format) {
	if($format['size'] !== '0B'){
		$total_audios = $total_audios + 1;
	}
}
