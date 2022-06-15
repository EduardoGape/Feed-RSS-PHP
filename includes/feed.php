<?php 
    //DEPENDENCIAS
    use \App\Feed\tec;

    //INSTANCIA DO FEED
    $obFeed = new tec;

    //DATA DE ATUALIZACAO
    $lastUpdate = date('d/m/y à\s H:i:s', strtotime($obFeed->getLastUpdate()));

    $items = "";

    //ITERA TODAS AS POSICOES DOS ITENS DO FEED
    foreach($obFeed->getItems() as $item){
        //IMAGE DO ITEM
        $image = $item->enclosure->attributes()->url;

        //DATA DE PUBLICACAO ITEM
        $date = date('d/m/Y à\s H:i:s', strtotime($item->pubDate));
        //LAYOUT CARD
        $items .= '<div class="col mb-4">
                        <div class="card text-dark h-100">
                        <div class="card-body">
                            <span class="badge bg-primary">'.$item->caregory.'</span>
                            <img src="'.$image.'" class="card-img-top" alt="'.$item->title.'">
                            <h5 class="card-title">'.$item->title.'</h5>
                            <p class="card-text">'.$item->description.'</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Publicado em '.$date.'</small>
                        </div>
                        </div>
                    </div>';
    }

    /*echo "<pre>";
    print_r($obFeed->getTitle());
    echo "</pre>";exit;*/
?>
<div class="text-center">
    <img src="<?=$obFeed->getLogo()?>" alt="logo" class="mb-3">
    <h1 class="mb-0"><?=$obFeed->getTitle()?></h1>
    <p class="mb-0"><?=$obFeed->getDescription()?></p>
    <p class="text-muted mb-4"><?=$lastUpdate?></p>
</div>
<div class="row row-cols-1 row-cols-md-2 g-4">
  <?=$items?>
</div>