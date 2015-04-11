#!/usr/bin/php
<?php
function contextio(){
// remove first line above if you're not running these examples through PHP CLI
include_once("class.contextio.php");
// see https://console.context.io/#settings to get your consumer key and consumer secret.
$contextIO = new ContextIO('6bbaozd7','WucIFMnI5UkHfruB');
$accountId = null;
// list your accounts
$r = $contextIO->listAccounts();
foreach ($r->getData() as $account) {
	echo $account['id'] . "\t" . join(", ", $account['email_addresses']) . "\n";
	if (is_null($accountId)) {
		$accountId = $account['id'];
	}
}
if (is_null($accountId)) {
	die;
}
// Get the most recent drafts message reciepient
$messageListResponseDrafts = $contextIO->listMessages($user['id'], array('label' => 0, 'folder' => $folder['[Gmail]/Drafts']));
$messagesDrafts = $messageListResponseDrafts->getData();
$messageRecent= $messagesDrafts[0];
$toEmail= $messageRecent->addresses->to[0]->email;

// EXAMPLE 1
// Print the subject line of the last 100 emails sent to with bill@widgets.com
$args = array('to'=>$toEmail, 'limit'=>100);
echo "\nGetting last 100 messages exchanged with {$args['to']}\n";
$r = $contextIO->listMessages($accountId, $args);
foreach ($r->getData() as $message) {
	echo "Subject: ".$message['subject']."\n";
}

// EXAMPLE 2
// Print the Data  of the last 100 emails sent to with bill@widgets.com
$args = array('to'=>$toEmail, 'limit'=>100);
echo "\nGetting last 100 messages exchanged with {$args['to']}\n";
$r = $contextIO->listMessages($accountId, $args);
foreach ($r->getData() as $message) {
	echo "Message: ".$message['bodies']."\n";
}

// EXAMPLE 3
// Download all versions of the last 2 attachments exchanged with bill@widgets.com
$saveToDir = dirname(__FILE__)."/".mt_rand(100,999);
mkdir($saveToDir);
$args = array('email'=>'bill@widgets.com', 'limit'=>2);
echo "\nObtaining list of last two attachments exchanged with {$args['email']}\n";
$r = $contextIO->listFiles($accountId, $args);
foreach ($r->getData() as $document) {
	echo "\nDownloading all versions of document \"".$document['file_name']."\"\n";
	foreach ($document['occurrences'] as $attachment) {
		echo "Downloading attachment '".$attachment['file_name']."' to $saveToDir ... ";
		$contextIO->getFileContent($accountId, array('file_id'=>$attachment['fileId']), $saveToDir."/".$attachment['file_name']);
		echo "done\n";
	}
}
// EXAMPLE 4
// Download all attachments with a file name that matches 'creenshot'
$saveToDir = dirname(__FILE__)."/".mt_rand(100,999);
mkdir($saveToDir);
echo "\nDownloading all attachments matching 'creenshot'\n";
$args = array('file_name'=>'creenshot');
$r = $contextIO->listFiles($accountId, $args);
foreach ($r->getData() as $attachment) {
	echo "Downloading attachment '".$attachment['file_name']."' to $saveToDir ... ";
	$contextIO->getFileContent($accountId, array('file_id'=>$attachment['file_id']), $saveToDir."/".$attachment['file_name']);
	echo "done\n";
}
echo "\nall examples finished\n";
}


//contextio();
$text="written into the Trans-Pacific Partnership (TPP) and other trade agreements being negotiated by the Office of the United States Trade Representative. I oppose “trade” policies that are developed without proper oversight or input from the public. The shear fact that wikileaks was the source to provide the full text of the bill should indicate that TPP outlines laws which are NOT in the best interests of the general public, since the laws had to be hidden from the public. TPP contains clauses which are unacceptable. These clauses will extend pharmaceutical drug patents, restrict internet freedoms, and create a legal framework for companies to sue nations over potential profit loss.
Extending pharmaceutical patents beyond the current 20 years will prevent generic drug production forcing patients to pay more for the same medication. This disincentives investment in research and development of new and better drugs, and at a time when drug companies already spend 1.5-2 times more on marketing, the"; //where text is the output of the context.io pull

$watsonString= "$'".$text."'";
$command = "curl 'https://gateway.watsonplatform.net/personality-insights/api/v2/profile?header=false' -H 'Authorization: Basic ZjE0YjlkMGItM2NlZC00NWM3LTk4YzMtOTllZDBlYzllOTZmOjRpYkRWSG5Oam9VVw==' -H 'Origin: chrome-extension://fdmmgilgnpjigdojojpjoooidkmcomcm' -H 'Accept-Encoding: gzip, deflate' -H 'Accept-Language: en' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36' -H 'Content-Language: en' -H 'Accept: application/json' -H 'Cache-Control: no-cache' -H 'Cookie: Watson-DPAT=UmxwUnA5QTRyN2xYMGlXZFdsWU5KcjZTVXJ4Sld1SU1tbnEvMTduYmszMXM1QnUzdkZhOU5RU2ZtbFZ3ZGZIQWRVQnFsSmhYMkliMjltOXRjVnlNS3JRMXdJU25mL2k3V0k0UGVYODVDcHMwT29DOWZoZDdxVnhPcDBYemluTk42MDJKK0hDcWt4TjVEeVlCSDVMM1FJQy9nSHA1VnZaanYrL2pjalFoU0tUR2VXWUJaZzNYeVk3UE1MMkR1UUpZMW1abmdCR3F2S2ZhOUlnK1gxaTl4QTgwdTBKNUJLclQ3Y1MxL09aRXl1aUVMYzJjbjZ3dUhnZFBXQnlwcnBXUjVEWXBKL1VVL0JqQXhIRDJGTy9EeGFsNHNBbjZKTnBLZHJwWjVBd1EyTFo3OXpSalJ6ZXM2dTQ0cVErb3o4V0puWGFyMUdTQ05HSEI4dm9ka0ptQTVEZ3FUTVRaODJXTHBPeEU2a1Q1V0UwPQ==' -H 'Connection: keep-alive' -H 'Content-Type: text/plain' --data-binary ".$watsonString." --compressed";
$watsonOutput = exec($command);
//$location = strpos ($output , '{');
//echo($output);
//echo("\n");
//echo($location."\n");
$json = json_decode($watsonOutput);
var_dump($json);

<p>hello</p>














?>