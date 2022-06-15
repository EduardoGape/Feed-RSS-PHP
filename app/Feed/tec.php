<?php
    namespace App\Feed;

    class tec{
        const FEED_URL = 'https://rss.tecmundo.com.br/feed';
        private $feed = null;

        public function __construct(){
            $this->loadFeed();
        }
        private function loadFeed(){
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL            => self::FEED_URL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST  => 'GET'
            ]);
            //EXECUTE A REQUISIÇÃO CURL
            $response = curl_exec($curl);
            //FECHA A CONEXÃO
            curl_close($curl);

            //executa metodo xml
            return $this -> parseXML($response);
        }
        private function parseXML($response){
            //VERIFICA CONTEUDO DO ARQUIVO
            if(!strlen($response)) return false;
            //CARREGA O XML PARA A CLASSE
            $this -> feed =  simplexml_load_string($response);

            return true;
        }
        public function getTitle(){
            //Titulo
            return $this->feed->channel->title;
        }
        public function getDescription(){
            //Descricao
            return $this->feed->channel->description;
        }
        public function getLastUpdate(){
            //Atualiza Feed
            return $this -> feed->channel->lastBuildDate;
        }
        public function getLogo(){
            return $this->feed->channel->image->url;
        }
        public function getItems(){
            return $this->feed->channel->item;
        }
    }
?>