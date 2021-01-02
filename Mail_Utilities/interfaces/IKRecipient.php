<?php
namespace Mail_utilities;

interface IKRecipient
{
    public function getName();
    public function getEmail();
    public function getArrValue();
    public function _toJson();
}