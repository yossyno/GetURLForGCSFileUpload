	/**
	 * GSC�ɃA�b�v���[�h����URL���擾����B
	 */
	public function getGcsUploadUrl($responsePath){

		$outputType = Input::get('outputtype');
		
		if($tokenCheck){

			//Get GCS bucket name
			$options = array('gs_bucket_name' => CloudStorageTools::getDefaultGoogleStorageBucketName() );

			//Set ResponsePath URL and Url for  Upload Image
			$upload_url = CloudStorageTools::createUploadUrl(responsePath, $options);

			$result["header"]["status"] = "success";
			$result["uploadurl"] = $upload_url;
			self::outputTypeDeal($result,$outputType);
			Log::info('GCS�A�b�v���[�hURL�擾',array('function' =>"file:".__FILE__." url:".$upload_url." class:".__CLASS__." function:".__FUNCTION__));
			exit;
		}else{

			//�G���[��Ԃ�
			$result["header"]["status"] = "failed";
			$result["message"] = "error:".$img_type;
			self::outputTypeDeal($result,$jsonFlg);
			Log::info('GCS�A�b�v���[�hURL�擾���s',array('function' =>"file:".__FILE__." class:".__CLASS__." function:".__FUNCTION__));
			exit;
		}
	}
	
	private function outputTypeDeal($result,$outputType){
		if($outputType=="json"){
			Res::outputJson($result);
		}else if($outputType=="xml"){
			Res::outputXml($result);
		}
	}