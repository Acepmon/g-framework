<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class CarNewManufactureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marksModels = [
            'AEV' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Agrale' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Albion' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'AM General' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Amico Azar Motor Industrial Co' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Amur' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'AMW' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Argyle' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Armstrong' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Ashok Leyland' =>['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'Asia MotorWorks (AMW)' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Asiastar' =>['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Askam' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Astra' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Atkinson' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Autocar' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Avia Trucks' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'AVM' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'AvtoVAZ' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'AWD' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Az Universal Motors' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Ankai' =>['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Arboc' =>['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Ashok' =>['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'Ace' =>['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Aichi' =>['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Atlas' =>['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            
            'Bailey' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Beau-Roc' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'BeiBen' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Beijing Automobile Works(BAW)' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'BelAZ' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'BEML' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Bering Trucks' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'BharatBenz' =>['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'BMC' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Brabus' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Bremach' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Brockway' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Büssing' =>['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'BYD Company' =>['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'Belarus' =>['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Bobcat' =>['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Bomag' =>['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Company' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'C&C' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Callaway' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'CAMC' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Carmichael' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Cenntro' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'CEV' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Chery' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'CNJ' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Colet' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Crane Carrier Corporation (CCC)' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Champion' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Changan' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'Ciferal' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Cobus' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Collins' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Case' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'CAT' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Caterpillar' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'Cathefeng' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Cema' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Changlin' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Cummins' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'DAC' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Dacia' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Dadi' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Dart' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Dennis' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Dennison' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Diamond T' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Dina' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Daimler Group' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'DAF Trucks' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'Dayun' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'DEMAG' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Doosan' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Dynapac' => ['normal'=>'1','truck'=>'1','bus'=>'0','special'=>'1'],

            'Ebro' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'ERF' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Euclid Trucks' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Eicher Motors'=> ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'Eldorado'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Enc'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Everdigm'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'FAP'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Fassi'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Flextruc'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Foden'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Forland'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Freightliner'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'FTF Trucks'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Federal'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Force Motors'=> ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'Fayat'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Foton'=> ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'1'],
            'Furukawa'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Fuso'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Garner'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Garrett'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'General Motors(GM)'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Genoto'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Gilford'=> ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'GINAF'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Gonow'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Gräf & Stift'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Greenkraft Inc'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'GAZ OAO'=> ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'Gillig'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Golden dragon'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Goshen'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],

            'Hafei'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Haulamatic'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Hayes Truck'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Hendrickson'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Hindustan Motors'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Hino'=> ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'1'],
            'Hitachi'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'Hohan'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Hongyan'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'HSV'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Hualing Xingma Automobile' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Henan Shaolin' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Higer' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Hino' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'1'],
            'Huazhong' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Hunan' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Halla' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Hamm' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Hanix' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'HBXG' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Heli' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Hino' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'1'],
            'Hitachi' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],

            'International' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Iran Khodro' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Iveco' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Irisbus Iveco' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'IHI' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'JAC' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'JAC Motors(Anhui Jianghuai Automobile)' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Jiangling' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'JMC' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'J-Bus' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Jiangsu Alpha' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Jcb' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Jingong' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'John Deere' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Karry' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Kenworth' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'King Long' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Kingstar' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Krystal' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Ksir' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Kamaz' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'1'],
            'Kato' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Kawasaki' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Kobelco' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Komatsu' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'KrAZ' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'Kubota' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Leader Trucks' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Leyland' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Lincoln' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Liuzhou motor' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Lomont' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Liaz' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'L&T' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Lgmg' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Liebherr Group' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'Linuo' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Liugong' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Lonking' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Lovol' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Mack' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Mahindra' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'MAN' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'1'],
            'Marmon' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Master' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Maxus' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'MAZ(Minsk Automobile Plant)' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Multicar' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'MZKT' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Marcopolo' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Muran' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'MV-1' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Manitowoc' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Meiwa' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Morooka' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Navistar International' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'New Sentosa CV' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Nanjing' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Nor-Cal Vans' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'N.Traffic' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'New Holland' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'North Benz' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'OAF' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Orange EV' => ['normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],
            'Oshkosh' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Otokar' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],

            'Paccar' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Pegaso' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Perkasa Truck' => ['normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],
            'Perlini' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Persika' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Peterbilt' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Polarsun' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Proton' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'PAZ' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Proterra' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],

            'Qingling' => ['normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],

            'Ralph' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Rivian' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Roman' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Reddot' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Rightchoice' => ['normal'=>'1','truck'=>'1','bus'=>'0','special'=>'1'],

            'SAIC-Iveco Hongyan' => ['normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],
            'SAIPA' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Saleen' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Saviem' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'SCAM' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'SD' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Sentinel' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Shaanxi' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Shacman' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Shangdong Wuzheng Group' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Shelby' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Silant' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Sisu' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Sitom' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Sitrak' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Smith' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'SNVI' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Star' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Steyr' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Shenzhen Wuzhoulong motors Group' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'SML Isuzu' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'Solaris' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Sunlong' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Suzhou' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Sakai' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Sany' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Scania' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'1'],
            'Schaeff' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'SDLG' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Sem' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Shacman' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'Shandong' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Shantui' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Sinomach' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Sinotruk' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'1'],
            'Sonstige' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Sumitomo' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Sunward' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Tatra' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'TAV' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Terberg' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Tiger Truck' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Tonar' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'TVS' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Tata' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'Temsa' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Trans Tech Buses' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Turbus' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Turtle Top Buses' => ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Tadano' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'Taian Zhengtai' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'TCM' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Terex' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'Triton Valves' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Tym' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Union' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'UralAZ' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Uri' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'UD Trucks' => ['normal'=>'0','truck'=>'1','bus'=>'1','special'=>'0'],
            'Universal' => ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Vauxhall' => ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Vehicle Factory Jabalpur (VFJ)'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'VDL'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Vision Bus'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Volare'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Volgren'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Vogele'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Western Star'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Workhorse'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'World Trans'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Wecan'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Wirtgen'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'XCMG'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'1'],
            'XGMA'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Xiajin'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Yarovit'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Yuejin'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Yulon'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Yaxing'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Yutong'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Yanmar'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Yongmao'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'YTO'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],
            'Yugong'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1'],

            'Zastava'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Ziyang Nanjun'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'ZX'=> ['normal'=>'0','truck'=>'1','bus'=>'0','special'=>'0'],
            'Zhongtong Bus'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Zuhai'=> ['normal'=>'0','truck'=>'0','bus'=>'1','special'=>'0'],
            'Zoomlion'=> ['normal'=>'0','truck'=>'0','bus'=>'0','special'=>'1']
        ];

        $carManufacturer = TaxonomyManager::register('Car Manufacturer', 'car', null, ['metaKey' => 'markName']);
        foreach ($marksModels as $mark => $models) {
            $markTaxonomy = TaxonomyManager::register($mark, 'car-manufacturer', $carManufacturer->term->id, [
                'logo' => url(asset('images/manufacturers/' . \Str::slug($mark) . '.png')),
                'metaKey' => 'modelName'
            ], $models);
            if (array_key_exists('children', $models)) {
                foreach ($models['children'] as $model) {
                    TaxonomyManager::register($model, 'car-' . \Str::kebab($mark), $markTaxonomy->term->id);
                }
            }
            TaxonomyManager::updateTaxonomyChildrenSlugs($markTaxonomy->id);
        }
        TaxonomyManager::updateTaxonomyChildrenSlugs($carManufacturer->id);
    }
}
