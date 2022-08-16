<?php

namespace MopManager;

class CRMConvertionItem
{
  public $idmop_crm_from_to;
  public $from;
  public $to;

  function __construct($id, $from, $to)
  {
    $this->idmop_crm_from_to = $id;
    $this->from = $from;
    $this->to = $to;
  }
}