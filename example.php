<?php

	require __DIR__.'/src/edsonmedina/bittrex/Client.php';

	use edsonmedina\bittrex\Client;

	$key = '4bec433f95e54562aeeefae92ebedb84';
	$secret = '6171690af7364ea2a951dc85d00e1130';

	$b = new Client ($key, $secret);
	$result = array();
	$markets = array();
	$marketsummary = array();
	//var_dump ($b->buyLimit ('BTC-DAR', 10.9, 0.00005488));
	var_export ($b->getMarkets ());
	$markets = $b->getMarkets ();
	foreach ($markets as $item) {
    		$marketname = $item->MarketName;
    		$marketsummary = $b->getMarketSummary ($marketname);
		$volume = $marketsummary[0]->Volume;
		$ask = $marketsummary[0]->Ask;
		if($volume >= 0.2 && $ask>= 0.0000003){
			$buyqua = 0.0006/$ask;
			$b->buyLimit ($marketname, $buyqua, $ask);
		}
	}
	//echo $ask;
        //var_export ($b->getMarketSummary ('BTC-DAR'));
        //$result = $b->getMarketSummary('BTC-DAR');
        //$ask = $result[0]->Ask;
	
	echo "\n\n";





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
                $marketsummary = $b->getMarketSummary ($marketname);
                $bid = $marketsummary[0]->Bid;
                $balance = $b->getBalance ($currency);
                $mybalance = $balance->Available;
                if($mybalance != 0){
                        $b->sellLimit ($marketname, $mybalance, $bid);
                        echo $mybalance." ".$currency." "."with price of"." ".$bid." "."sold\n";
                        sleep(1);
                }
        }
        echo "\n\n";
