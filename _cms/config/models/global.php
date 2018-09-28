<?php

Class CoinInfo{
	var $id = 0;
	var $name = '';
	var $symbol = '';
	var $decimals = 0;
	
	function __construct($args=array()) {
		if(isset($args['id'])){ $this->id = (int) $args['id']; }
		if(isset($args['name'])){ $this->name = (string) $args['name']; }	
		if(isset($args['symbol'])){ $this->symbol = (string) $args['symbol']; }	
		if(isset($args['decimals'])){ $this->decimals = (int) $args['decimals']; }	
	}
}

Class BalanceWallet{
	var $coin_id = 0;
	var $balance = 0;
	var $address = '';
	var $name = '';
	var $symbol = '';
	var $decimals = '';
	
	function __construct($args=array()) {
		if(isset($args['coin_id'])){ $this->coin_id = (int) $args['coin_id']; }
		if(isset($args['address'])){ $this->address = (string) $args['address']; }
		if(isset($args['balance'])){ $this->balance = (int) $args['balance']; }
		if(isset($args['symbol'])){ $this->symbol = (string) $args['symbol']; }	
		if(isset($args['name'])){ $this->name = (string) $args['name']; }	
		if(isset($args['decimals'])){ $this->decimals = (int) $args['decimals']; }	
	}
}


Class UserInfo{
	var $id = 0;
	var $nick = '';
	var $hash = '';
	var $name = '';
	var $mail = '';
	var $refers = 0;
	var $create = 0;
	var $last_activity = 0;
	var $actived = 0;
	var $banned = 0;
	var $token = '';
	var $wallets = null;
	
	function __construct($args=array()) {
		if(isset($args['id'])){ $this->id = (int) $args['id']; }
		if(isset($args['nick'])){ $this->nick = (string) $args['nick']; }
		if(isset($args['hash'])){ $this->hash = (string) $args['hash']; }
		if(isset($args['name'])){ $this->name = (string) $args['name']; }
		if(isset($args['mail'])){ $this->mail = (string) $args['mail']; }
		if(isset($args['points'])){ $this->points = (int) $args['points']; }
		if(isset($args['refers'])){ $this->refers = (int) $args['refers']; }
		if(isset($args['create'])){ $this->create = $args['create']; }
		if(isset($args['last_activity'])){ $this->last_activity = $args['last_activity']; }
		if(isset($args['actived'])){ $this->actived = (boolean) $args['actived']; }
		if(isset($args['banned'])){ $this->banned = (boolean) $args['banned']; }
		$this->token = createToken($this->id, $this->nick, $this->hash);
		$this->wallets = loadWallets($this->id);
	}
}

Class TransferInfo{
	var $id = 0;
	var $tx = '';
	var $from = '';
	var $to = '';
	var $value = 0;
	var $fee = 0;
	var $data = '';
	var $coin = '';
	var $create = 0;
	var $coinInfo = null;
	
	function __construct($args=array()) {
		if(isset($args['id'])){ $this->id = (int) $args['id']; }
		if(isset($args['tx'])){ $this->tx = (string) $args['tx']; }
		if(isset($args['from'])){ $this->from = (string) $args['from']; }
		if(isset($args['to'])){ $this->to = (string) $args['to']; }
		if(isset($args['value'])){ $this->value = (float) $args['value']; }
		if(isset($args['fee'])){ $this->fee = (float) $args['fee']; }
		if(isset($args['data'])){ $this->data = (string) $args['data']; }
		if(isset($args['create'])){ $this->create = (string) $args['create']; }
		if(isset($args['coin'])){ $this->coin = (int) $args['coin']; }
		$this->coinInfo = CoinForId($this->coin);		
	}
}




