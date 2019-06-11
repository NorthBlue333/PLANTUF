<?php
function fetchAllSecure($data) {
  if($data) {
    return $data->fetchAll();
  } else {
    return false;
  }
}
function fetchSecure($data) {
  if($data) {
    return $data->fetch();
  } else {
    return false;
  }
}
function checkSetEmpty($value) {
  if(isset($value) && !empty($value)) {
    return $value;
  } else {
    return false;
  }
}
?>
