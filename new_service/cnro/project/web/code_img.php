<?php

session_name('cnro2009');
session_start();

// generate 4 digit random number
$rndval = rand(1000, 9999);

$_SESSION['auth_code']='';
$_SESSION['auth_code']=$rndval;

// create the image
$img = imagecreate(45, 20);

// set background image
$bgc = imagecolorallocate ($img, 255, 251, 205);

// the text color is black
$fontcolor = imagecolorallocate ($img, 0, 0, 0);

// write the random number
imagestring ($img, 4, 5, 3, $rndval, $fontcolor);

// send the content type header so the image is displayed properly
header('Content-type: image/jpeg');

// send the image to the browser
imagejpeg($img);

// destroy the image to free up the memory
imagedestroy($img);


//////////////////////////////////////////////////////////////////


/*

session_name('cnro2009');
session_start();

//������֤��ͼƬ
Header("Content-type: image/PNG");

srand((double)microtime()*1000000);//����һ������������ֵ����ӣ��Է���������������ɵ�ʹ��

//session_start();//�����������session��
$_SESSION['auth_code']="";
$im = imagecreate(70,20) or die("Cant's initialize new GD image stream!"); //�ƶ�ͼƬ������С
$black = ImageColorAllocate($im, 0,0,0); //�趨������ɫ
$white = ImageColorAllocate($im, 255,255,255);
$gray = ImageColorAllocate($im, 200,200,200);

imagefill($im,0,0,$gray); //����������䷨���趨��0,0��

//�������ֺ���ĸ��ϵ���֤�뷽��
$ychar="0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
$list=explode(",",$ychar);
for($i=0;$i<4;$i++){
$randnum=rand(0,35);
$authnum.=$list[$randnum];
}

//while(($authnum=rand()%100000)<10000); //���������������
//����λ������֤�����ͼƬ
$_SESSION['auth_code']=$authnum;

imagestring($im, 5, 10, 3, $authnum, $black);
// �� col ��ɫ���ַ��� s ���� image �������ͼ��� x��y ���괦��ͼ������Ͻ�Ϊ 0, 0����
//��� font �� 1��2��3��4 �� 5����ʹ����������

for($i=0;$i<200;$i++) //�����������
{
$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
}
ImagePNG($im);
ImageDestroy($im);


*/

