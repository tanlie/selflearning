

class hello {

	public static void main(String[] args)
	{
		System.out.println("this is a java project");
	}

}


$tcp_worker->onMessage = function($connection,$data){
	setLogs('socket',$data); //将收到的信息记录下来
	
	$rec = json_decode($data,true); //将收到的信息转为phps数组
	$out = [];
	if($rec['cmd']=='loadkey'){      //loadkey命令
	    $out['msg'] = 'FF72E8FF72E8';
	    $out['result'] ='200';
	    $out['sign'] = '123456';
	    $out['sn'] = $rec['sn'];
	} elseif ($rec['cmd'] == 'loadcard'){ //loadcard命令
		if($rec['msg'] && $rec['msg'] != 'OK'){
			$member_cardno = $rec['msg']; //拿到会员卡信息，进行业务处理
		}

		$out['msg'] = '自定义内容';
	    $out['result'] ='200';
	    $out['sign'] = '123456';
	    $out['sn'] = $rec['sn'];
	}
	$str = json_encode($out,JSON_UNESCAPED_UNICODE);
	$connection->send($str); //回复客户端
};

