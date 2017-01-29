massbuy.php:
<?php

	require __DIR__.'/src/edsonmedina/bittrex/Client.php';

	use edsonmedina\bittrex\Client;

	$key = '4bec433f95e54562aeeefae92ebedb84';
	$secret = '6171690af7364ea2a951dc85d00e1130';

        $b = new Client ($key, $secret);
        $balance = array();
        $markets = array();
        $marketsummary = array();
//      var_export ($b->getMarkets ());
        $markets = $b->getMarkets ();
        foreach ($markets as $item) {
                $marketname = $item->MarketName;
                $currency = $item->MarketCurrency;
                $isactive = $item->IsActive;
                $marketsummary = $b->getMarketSummary ($marketname);
                $volume = $marketsummary[0]->BaseVolume;
                $ask = $marketsummary[0]->Ask;
                $balance = $b->getBalance ($currency);
                $mybalance = $balance->Available;
                if($isactive && $mybalance == 0 && $volume >= 1 && $ask>= 0.0000003 && $currency != "BTC" && $marketname != "ETH-ETC" && $marketname != "ETH-ETC"){
                        $buyqua = 0.0006/$ask;
                        echo $buyqua." ".$currency." "."with price of"." ".$ask." "."bought. volume= ".$volume."\n";
                        $b->buyLimit ($marketname, $buyqua, $ask);
                        sleep(1);
		}
	}
	//echo $ask;
        //var_export ($b->getMarketSummary ('BTC-DAR'));
        //$result = $b->getMarketSummary('BTC-DAR');
        //$ask = $result[0]->Ask;
	
	echo "\n\n";




mass_sell.php:
<?php

	require __DIR__.'/src/edsonmedina/bittrex/Client.php';

	use edsonmedina\bittrex\Client;

	$key = '4bec433f95e54562aeeefae92ebedb84';
	$secret = '6171690af7364ea2a951dc85d00e1130';

        $b = new Client ($key, $secret);
        $balance = array();
        $markets = array();
        $marketsummary = array();
        $markets = $b->getMarkets ();
        foreach ($markets as $item) {
                $marketname = $item->MarketName;
                $currency = $item->MarketCurrency;
                $isactive = $item->IsActive;
                $marketsummary = $b->getMarketSummary ($marketname);
                $bid = $marketsummary[0]->Bid;
                $balance = $b->getBalance ($currency);
                $mybalance = $balance->Available;
		$btcvalue = $bid * $mybalance;
                if($isactive && $mybalance != 0 && $currency != "BTC" && $btcvalue >= 0.00065 && $marketname != "ETH-ETC" && $marketname != "ETH-ETC"){
                        $b->sellLimit ($marketname, $mybalance, $bid);
                        echo $mybalance." ".$currency." "."with price of"." ".$bid." "."sold\n";
                        sleep(1);
                }
        }
        echo "\n\n";
