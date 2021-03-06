<?php
require __DIR__ . '/src/autoload.php';

/**
 * Authorization Tokens are created by either:
 * [1] OAuth workflow: https://dev.evernote.com/doc/articles/authentication.php
 * or by creating a 
 * [2] Developer Token: https://dev.evernote.com/doc/articles/authentication.php#devtoken
 */
$token = 'S=s1:U=96447:E=17e8dea5f9c:C=177363931f0:P=1cd:A=en-devtoken:V=2:H=36134ff369087b0d1df6adf82c4e6f59';

/** Understanding SANDBOX vs PRODUCTION vs CHINA Environments
 *
 * The Evernote API 'Sandbox' environment -> SANDBOX.EVERNOTE.COM 
 *    - Create a sample Evernote account at https://sandbox.evernote.com
 * 
 * The Evernote API 'Production' Environment -> WWW.EVERNOTE.COM
 *    - Activate your Sandboxed API key for production access at https://dev.evernote.com/support/
 * 
 * The Evernote API 'CHINA' Environment -> APP.YINXIANG.COM
 *    - Activate your Sandboxed API key for Evernote China service access at https://dev.evernote.com/support/ 
 *      or https://dev.yinxiang.com/support/. For more information about Evernote China service, please refer 
 *      to https://dev.evernote.com/doc/articles/bootstrap.php
 *
 * For testing, set $sandbox to true; for production, set $sandbox to false and $china to false; 
 * for china service, set $sandbox to false and $china to true.
 * 
 */
$sandbox = true;
$china   = false;

$client = new \Evernote\Client($token, $sandbox, null, null, $china);

$note         = new \Evernote\Model\Note();
$note->title  = 'Test reminder from API 01-26*';
$note->content = new \Evernote\Model\PlainTextNoteContent('Test reminder from API on 01-26-2021*');

//$now = round(microtime(true) * 1000);
//$then = $now + 3600000; // one hour after `now`
 
 date_default_timezone_set('America/New_York');
 $due = strtotime("2021-01-28T08:30")*1000;
 
 
// init NoteAttributes instance
$note->attributes = new \EDAM\Types\NoteAttributes();
$note->attributes->reminderOrder = $due;
$note->attributes->reminderTime = $due;


$uploaded_note = $client->uploadNote($note);


echo "DONE - new note guid = " . $uploaded_note->guid;

/*
$datetime = new \DateTime('tomorrow');

// Check if the note "is" a reminder
var_dump($uploaded_note->isReminder());

// Set a reminder. The parameter is a timestamp in seconds.
$uploaded_note->setReminder($datetime->getTimestamp());

$client->uploadNote($uploaded_note);

var_dump($uploaded_note->isReminder());
var_dump($uploaded_note->getReminderTime());

// Check if the reminder has been set as done.
var_dump($uploaded_note->isDone());

$uploaded_note->setAsDone();

$client->uploadNote($uploaded_note);

var_dump($uploaded_note->isReminder());
var_dump($uploaded_note->getReminderDoneTime());
var_dump($uploaded_note->isDone());

// Clean the note of any reminder attributes
$uploaded_note->clearReminder();

$client->uploadNote($uploaded_note);

var_dump($uploaded_note->isReminder());
var_dump($uploaded_note->isDone());
*/