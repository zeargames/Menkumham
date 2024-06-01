system("clear");
$k = "\033[33;1m";
$h = "\033[32;1m";
$p = "\033[37;1m";
$m = "\033[31;1m";
$o = "\033[30;1m";

echo $p."\t╭────────────────────────────────╮\n";
echo $p."\t│          ".$h."Bot Dor BIZ XL".$p."        │\n";
echo $p."\t│      ".$p."Author: bian  ".$p."   │\n";
echo $p."\t│  ".$p."Telegram: t.me/INJECT".$p." │\n";
echo $p."\t│   ".$p."Website: INJECT".$p."   │\n";
echo $p."\t│       ".$p."Youtube: ".$k."bian".$p."       │\n";
echo $p."\t╰────────────────────────────────╯\n\n";


system("xdg-open https://youtu.be/hD--X_6slI0");
sleep(1);
$no = readline($p."\t [📳] Input Number   ".$m.": ".$k);

$ua=array(
	"Host:bizxl.netlify.app",
	"user-agent:Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Mobile Safari/537.36",
	"content-type:application/json",
	"origin:https://bizxl.netlify.app",
	"sec-fetch-site:same-origin",
	"sec-fetch-mode:cors",
	"sec-fetch-dest:empty",
	"referer:https://bizxl.netlify.app/"
	
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://bizxl.netlify.app/api/users/otp");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data=('{"msisdn":"'.$no.'"}');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$res = curl_exec($ch);
$suc = preg_match("/SUCCESS/i",$res);

if($suc == "1"){
	$json = json_decode($res);
	$id = explode('next_resend_allowed_at\":\"',$res)[1];
	$id = explode('\"}',$id)[0];
	$auth = $json->message->authId;
	
	$f = fopen(".auth", "w");
	fwrite($f, $auth);
	fclose($f);
	$n = fopen(".id", "w");
	fwrite($n, $id);
	fclose($n);
	
	
	echo $p."\t╭────────────────────────────────╮\n";
	echo $p."\t│ ".$h."     OTP Success Terkirim!".$p."     │\n";
	echo $p."\t╰────────────────────────────────╯\n";
	
}else{
	echo $p."\t╭────────────────────────────────╮\n";
	echo $p."\t│ ".$m."      OTP Gagal Terkirim!".$p."      │\n";
	echo $p."\t╰────────────────────────────────╯\n";
	shell_exec("rm .json");
	exit();
}

$otp = readline($p."\t [🔑] Input Code OTP ".$m.": ".$k);
echo $p."\t ________________________________\n\n";
$tp = fopen(".otp", "w");
fwrite($tp, $otp);
fclose($tp);
shell_exec('bash log.sh');

$res = `cat .json`;

$suc = preg_match("/successUrl/i",$res);

if($suc == "1"){
	$json = json_decode($res);
	$tkn = $json->message->tokenId;
	
	echo $p."\t╭────────────────────────────────╮\n";
	echo $p."\t│ ".$h."         Login Success!".$p."        │\n";
	echo $p."\t╰────────────────────────────────╯\n";
	
}else{
	echo $p."\t╭────────────────────────────────╮\n";
	echo $p."\t│ ".$m."          Login Gagal!".$p."         │\n";
	echo $p."\t╰────────────────────────────────╯\n";
	shell_exec("rm .json");
	exit();
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://bizxl.netlify.app/api/users/buy");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$data=('{"idToken":"'.$tkn.'"}');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$res = curl_exec($ch);

$suc = preg_match("/Saldo Tidak Bisa/i",$res);
$cob = preg_match("/Coba Lagi/i",$res);
$bis = preg_match("/SUCCESS/i",$res);
sleep(1);
if($suc == "1"){
	echo $p."\t╭────────────────────────────────╮\n";
	echo $p."\t│ ".$m."      Harus Ada Pulsa 9K!".$p."      │\n";
	echo $p."\t╰────────────────────────────────╯\n";
	shell_exec("rm .json");
	exit();
}elseif($cob == "1"){
	echo $p."\t╭────────────────────────────────╮\n";
	echo $p."\t│ ".$k."         Ulang Lagi!".$p."           │\n";
	echo $p."\t╰────────────────────────────────╯\n";
	shell_exec("rm .json");
	exit();
}elseif($bis == "1"){
	echo $p."\t╭────────────────────────────────╮\n";
	echo $p."\t│ ".$h."         Dor Success!".$p."          │\n";
	echo $p."\t╰────────────────────────────────╯\n";
	shell_exec("rm .json");
	exit();
}else{
	echo $p."\t╭────────────────────────────────╮\n";
	echo $p."\t│ ".$h."          Dor Gagal!".$p."           │\n";
	echo $p."\t╰────────────────────────────────╯\n";
	shell_exec("rm .json");
	exit();
}
