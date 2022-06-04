<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('excel_import_model');
		$this->load->library('excel');
		$this->load->model('admin_detail');
	}

	function index()
	{
		$this->load->view('excel_import');
	}
	
	function fetch()
	{
		$data = $this->admin_detail->select();
		$output = '
		<h3 align="center">Total Data - '.$data->num_rows().'</h3>
		<table class="table table-striped table-bordered">
			<tr>
				<th>bull_no</th>
				<th>bull_id</th>
				<th>sire_no</th>
			</tr>
		';
		foreach($data->result() as $row)
		{
			$output .= '
			<tr>
				<td>'.$row->bull_no.'</td>
				<td>'.$row->bull_id.'</td>
				<td>'.$row->sire_no.'</td>
			</tr>
			';
		}
		$output .= '</table>';
		echo $output;
	}

	function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			$loppp = 1;
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$bull_no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$bull_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$sire_no = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$dob = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$category = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$sires_breed = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$dams_breed = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$dam_no = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$semen_type = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$seman_category = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$progini_test = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$is_imported = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$health_certificate = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$rating = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$progini_record = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$brochure = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$lat_yield = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$daughter_yield = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
					$total_milk_fat = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
					$total_milk_proteen = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
					$avg_milk_proteen = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
					$milk_type = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
					$vt_ai_price = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
					$image = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
					if(empty($empty)) {
						$image = '1581425594.jpg';
					}
					$video = $worksheet->getCellByColumnAndRow(21, $row)->getValue();

					if(!empty($bull_id) && $bull_id!='w') {
						$data['bull_no'] =	trim($bull_id);
						$data['bull_id'] =	trim($bull_id);
						$data['sire_no'] =	$sire_no;
						$var = $dob;
                        $date = str_replace('/', '-', $var);
  	                    $date = date('Y-m-d', strtotime($date));
						$data['dob'] =	$date;
                        $data['bull_name'] = $sires_breed;
                        $data['category'] = $this->admin_detail->get_category_id_by_name($category);
                        $data['dam_no'] = $dam_no;
                        $data['sires_breed'] = $sires_breed;
                        $data['dams_breed'] = $dams_breed;
                        $data['semen_type'] = $semen_type;
                        $data['seman_category'] = $seman_category;
                        $data['progini_test'] = $progini_test;
                        $data['is_imported'] = $is_imported;
                        $data['health_certificate'] = $health_certificate;
                        $data['rating'] = $rating;
                        $data['progini_record'] = $progini_record;
                        $data['brochure'] = $brochure;
                        $data['lat_yield'] = $lat_yield;
                        $data['daughter_yield'] = $daughter_yield;
                        $data['total_milk_fat'] = $total_milk_fat;
                        $data['total_milk_proteen'] = $total_milk_proteen;
                        $data['avg_milk_proteen'] = $avg_milk_proteen;
                        $data['milk_type'] = $milk_type;
                       	$data['vt_ai_price'] = $vt_ai_price;
                       	$data['image'] = $image;
                       	$data['video'] = $video;
						$iii = $this->admin_detail->get_bull_bullno(trim($bull_id));
						if(trim($iii[0]['bull_no']) != trim($bull_id)) {
							if($loppp==1) {
								$this->admin_detail->bull_table_add($data);
								$loppp = 2;
							}
						}
					}
				}
			}
			echo 'Data Imported successfully';
		}	
	}
}

?>