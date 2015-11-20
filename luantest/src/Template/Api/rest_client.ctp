<?php
$result_json = array (
		RESULT_CODE => $result_code,
		RESULT_DETAIL => $result_detail,
		RESULT_ERROR => $result_error 
);
echo json_encode ( $result_json );
?>