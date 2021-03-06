<?php

require_once("php/newsletter/common/common.php");
require_once("php/newsletter/settings/settings.php");

require_once("php/newsletter/attachments/attachments.php");
require_once("php/newsletter/images/images.php");

require_once("php/newsletter/messages/messages.php");
require_once("php/newsletter/addressbook/addressbook.php");

require_once("php/newsletter/mail/mail.php");


function ensureValidId($dir, $id) {
    
    if (strlen($id) === 0)
        throw new Exception("Empty Identifier");
    
    if (!preg_match('/^[a-f0-9]{2,}$/i', $id)) {
        throw new Exception("Invalid Identifier $id");
    }
    
    if (!file_exists($dir.$id)) {
        throw new Exception("Unknown Identifier $id for directory $dir");
        }
    
    return true;
}


function doDraftsList() {
    return (new Drafts())->enumerate();
}

function doDraftsNew($subject) {
    
    $draftItem = (new Drafts())->create();

    $draftItem->setSubject($subject);
    $draftItem->setMessage("");
    $draftItem->setModified();
    
    return [
    "id" => $draftItem->getId(),
    "subject" => $draftItem->getSubject(),
    "teaser" => $draftItem->getTeaser(),
    "modifier" => $draftItem->getModified(),
    "message" => $draftItem->getMessage()
    ];
}

function doDraftsDelete($id) {
    
    (new Drafts())->delete($id);
    return doDraftsList();
}


function doDraftsLoad($id) {
    
    $draftItem = (new Drafts())->load($id);
    
    return [
    "id" => $id,
    "subject" => $draftItem->getSubject(),
    "message" => $draftItem->getMessage()
    ];
}

function doDraftsSave($id, $subject, $message) {
    
    $draftItem = (new Drafts())->load($id);
    
    $draftItem->setSubject($subject);
    $draftItem->setMessage($message);
    $draftItem->setModified();
    
    return [
    "id" => $id,
    "subject" => $draftItem->getSubject(),
    "teaser" => $draftItem->getTeaser(),
    "modified" => $draftItem->getModified(),
    "message" => $draftItem->getMessage()
    ];
    
}

function doDraftsAttachmentsEnumerate($id) {

    $attachments = (new Drafts())->load($id)->getAttachments();

    return [
    "id" => $id,
    "attachments" => $attachments->enumerate(),
    "path" => $attachments->getDirectory()
    ];
}

function doDraftsAttachmentsUpload($id, $files) {
    
    ensureUploadIsValid($files);

    (new Drafts())->load($id)->getAttachments()->upload($files);
    
    return doDraftsAttachmentsEnumerate($id);
}

function doDraftsAttachmentsDelete($id, $attachment) {
    
    (new Drafts())->load($id)->getAttachments()->delete($attachment);
    return doDraftsAttachmentsEnumerate($id);
}

function doDraftsImagesUpload($id, $files) {

    $images = (new Drafts())->load($id)->getImages()->upload($files);
    
    return [
    "id" => $id,
    "src" => $images
    ];
}


function doDraftsSend($id, $addresses, $callback) {

    $draftItem = (new Drafts())->load($id);

    $mail = new Mail();

    $mail->setMessage($draftItem);    
    $mail->setAddresses((new AddressBook())->load($addresses));    

    $mail->send($callback);
    $mail->archive();

    return [];
}



function doArchivesList() {
    return (new Archive())->enumerate();
}

function doArchiveLoad($id) {
    
    $archiveItem = (new Archive())->load($id);
    
    return [
    "id" => $id,
    "subject" => $archiveItem->getSubject(),
    "message" => $archiveItem->getMessage()
    ];
}

function doArchiveSend($id, $addresses, $callback) {


    $archiveItem = (new Archive())->load($id);

    $mail = new Mail();

    $mail->setMessage($archiveItem);
    $mail->setAddresses((new AddressBook())->load($addresses));    

    $mail->send($callback);

    return [];
}

function doArchiveAttachmentsEnumerate($id) {

    $attachments = (new Archive())->load($id)->getAttachments();    

    return [
    "id" => $id,
    "attachments" => $attachments->enumerate(),
    "path" => $attachments->getDirectory()
    ];
}


function doAddressBookList() {
    return (new AddressBook())->enumerate();
}

function doAddressBookNew($name) {
    
    $addressBookItem = (new AddressBook())->create($name, "");
    $addressBookItem->setName($name);
    $addressBookItem->setAddresses("");
    $addressBookItem->setModified();
    
    return [
    "id" => $addressBookItem->getId(),
    "name" => $addressBookItem->getName(),
    "teaser" => $addressBookItem->getTeaser(),
    "modifier" => $addressBookItem->getModified(),
    "addresses" => $addressBookItem->getAddresses()
    ];
}

function doAddressBookDelete($id) {
    
    (new AddressBook())->delete($id);
    return doAddressBookList();
}

function doAddressBookLoad($id) {
    
    $addressBookItem = (new AddressBook())->load($id);
    
    return [
    "id" => $id,
    "addresses" => $addressBookItem->getAddresses(),
    "name" => $addressBookItem->getName()
    ];
}


function doAddressBookSave($id, $name, $addresses) {
    
    $addressBookItem = (new AddressBook())->load($id);
    
    $addressBookItem->setName($name);
    $addressBookItem->setAddresses($addresses);
    $addressBookItem->setModified();
    
    return [
    "id" => $id,
    "name" => $addressBookItem->getName(),
    "teaser" => $addressBookItem->getTeaser(),
    "modifier" => $addressBookItem->getModified(),
    "addresses" => $addressBookItem->getAddresses()
    ];
}


?>