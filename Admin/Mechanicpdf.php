<?php
require 'pdfcreate/fpdf.php';
include('../config.php');


class myPDF extends FPDF{
	

		
		function header(){
		    
			$this->SetFont('Arial','B',8);
			$this->Image('../img/mnrevisedlogo864-nooutline.png',240,1,30);
			$this->Cell(280,4,'REGISTERED MECHANIC REPORT',0,0,'C');
			$this->Ln();
			$this->SetFont('Arial','I',8);
			$this->Cell(213,4,' ',0,0,'C');
			$this->Ln(20);
		}
	
	


		function footer(){
	       

		$this->SetY(-80);
        $this->SetFont('helvetica','B',10);  
       // $this->Cell(315,30,'Total No. of Students: ',0,0,'C'); $this->Cell(-270,30,$data2->total,0,0,'C'); 
 
		$this->SetY(-10);
		$this->SetFont('Arial','B',8);
		$this->Cell(0,10,'Page'.$this->PageNo

().'/{nb}',0,0,'R');
			
		}

		function headertable(){

            $dbh1 = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$stmt1=$dbh1->query("SELECT * from mechanic where status='approve' order by mechID asc");
		    $data1=$stmt1->fetch(PDO::FETCH_OBJ);
			 $t= $stmt1->rowCount();        
		    /////$stmt1=$dbh1->query('Select semestername from students');
		   
			   date_default_timezone_set('Asia/Manila');
			    $currentDate = date("F j, Y g:i A ");

				$this->SetFont('Arial','B',8);

			    
			   $this->Cell(20,10,'Date Created: ',0,0,'C'); $this->Cell(30,10,$currentDate,0,0,'C');
			   $this->Cell(210,10,'Total: ',0,0,'R'); $this->Cell(1,10,$t,0,0,'C');
				$this->Ln(); 
               	$this->SetFont('Arial','B',8);
			   $this->Cell(200,10,' ',0,0,'C'); 
		       $this->Ln(5);
        	  // $this->Cell(200,8,$data1->semestername,0,0,'C'); 
				//$this->Ln(15);  
			  	$this->SetFont('Arial','B',8);
			  	$this->SetFillColor(230,230,0);
			  	$this->Cell(45,10,'Mechanic id',1,0,'C');
			  	$this->Cell(45,10,'Firstname',1,0,'C');
				$this->Cell(45,10,'Lastname',1,0,'C');
				$this->Cell(45,10,'Email',1,0,'C');
                $this->Cell(45,10,'Contact number',1,0,'C');
				$this->Cell(45,10,'Ratings',1,0,'C');

                

				
                
				$this->SetFont('Arial','B',8);
				

				$this->Ln(10);


}
function viewTable($dbh){

		$this->SetFont('helvetica','',8);
   
	   	
		//$regid  =intval($_GET['regid']);


$cnt=1;
$sql="SELECT * from mechanic where status='approve' order by mechID asc";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
    {
foreach($results as $result)
       
 		{
 				$this->Cell(45,10,$result->mechID,1,0,'C'); 
 				$this->Cell(45,10,$result->mechFirstname,1,0,'C'); 		
				$this->Cell(45,10,$result->mechLastname,1,0,'C');
				$this->Cell(45,10,$result->mechEmail,1,0,'C');
                $this->Cell(45,10,$result->mechCnumber,1,0,'C');
				 $sql1="SELECT *from request where mechID = $result->mechID";
                                            $query1 = $dbh->prepare($sql1);
                                            $query1->execute();
                                            $results=$query1->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query1->rowCount()>0){
                                                foreach($results as $result12){
													if(empty($result12->ratePercentage)){
														$this->Cell(45,10,$result->average,1,0,'C');

													}
													else {
														$this->Cell(45,10,$result12->ratePercentage,1,0,'C');
													}
													
                                                 
                                                 }} 
			
  			    $this->Ln();
		}	
	

    }

}}


$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
//$pdf= new PDF('P','mm',array(215.9,279.4));
$pdf->headertable();
//$pdf->footer1();
$pdf->viewTable($dbh);
$pdf->Output();

?>