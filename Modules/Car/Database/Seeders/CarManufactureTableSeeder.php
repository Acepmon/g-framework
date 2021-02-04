<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class CarManufactureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marksModels = [
            // Passenger
            'Acura'  => ['children' => ['CL' , 'MDX' , 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Audi'  => ['children' => ['A3', 'A4', 'A5', 'A6 Allroad Quattro', 'Q3', 'Q5', 'Q7', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Bentley'  => ['children' => [' Continental', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'BMW'  => ['children' => ['1Series', '3Series', '320 d', '5Series', '7Series', 'GT', 'i3', 'X1', 'X3', 'X5', 'X6', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Cadillac'  => ['children' => ['ATS', 'Escalade', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Chevrolet'  => ['children' => ['Aveo', 'Captiva', 'Colorado', 'Cruze', 'Equinox', 'Explorer', 'Express', 'Pickup', 'Suburban', 'Tahoe', 'Traverse', 'Winstorm', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Chrysler'  => ['children' => ['300 series', 'PT Cruiser', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Citroen'  => ['children' => ['C1', 'C3', 'C4', 'C5', 'C-Crosser', 'DS', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Daewoo'  => ['children' => ['Matiz', 'Rezzo', 'Tosca', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'Daihatsu'  => ['children' => ['Hijet', 'Terios', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],
            'Dodge'  => ['children' => ['Challenger', 'Ram series', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Ford'  => ['children' => ['EcoSport', 'Escape', 'Everest', 'Expedition', 'Explorer', 'F-Series', 'Fusion', 'Mustang', 'Ranger', 'Taurus', 'Transit', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'0'],
            'GMC'  => ['children' => ['Acadia', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Honda'  => ['children' => ['Accord', 'Airwave', 'Civic', 'CR-V', 'CR-Z', 'Element', 'Fit', 'Freed', 'HR-V', 'Insight', 'Logo', 'Odyssey', 'Pilot', 'Stream', 'Vezel', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'0'],
            'Hyundai'  => ['children' => ['Accent', 'Avante', 'Azera', 'County', 'Elantra', 'Excel', 'Grace', 'Grandeur', 'Kona', 'Santa Fe', 'Sonata', 'Sonata Hybrid', 'Starex', 'Terracan', 'Tucson', 'Veloster', 'Veracruz', 'Verna', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'Huansu-BASIC'  => ['children' => ['Kenbo 600', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Hummer'  => ['children' => ['H1', 'H2', 'H3', 'H3T', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],
            'Isuzu'  => ['children' => ['Trooper', 'Wizard', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'Infiniti'  => ['children' => ['EX Series', 'FX Series', 'G Series', 'M Series', 'Q Series', 'QX Series', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],
            'Jaguar'  => ['children' => ['XF', 'X-Type', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Jeep'  => ['children' => ['Cherokee', 'Compass', 'Gladiator', 'Grand Cherokee', 'Liberty', 'Patriot', 'Renegade', 'Wrangler', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],
            'Kia'  => ['children' => ['Bongo', 'Carens', 'Carnival', 'Cerato', 'K5', 'K7', 'Mohabe', 'Optima', 'Sorento', 'Sportage', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'Land Rover'  => ['children' => ['Defender', 'Discovery', 'Discovery Sport', 'Land Rover', 'Range Rover', 'Range Rover Evoque', 'Range Rover Sport', 'Range Rover Velar', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Lexus'  => ['children' => ['CT200h', 'ES ', 'GS', 'GX', 'HS', 'IS', 'LC', 'LS', 'LX 450', 'LX 460', 'LX 470', 'LX 570', 'NX', 'RC', 'RX 300', 'RX 330', 'RX 350', 'RX 400', 'RX 450', 'SC', 'UX', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Mazda'  => ['children' => ['Axela', 'Biante', 'Bongo', 'BT-50', 'CX Series', 'Demio', 'Eunos', 'Familia', 'Kabura', 'Laputa', 'Mazda2 Demio', 'Mazda3 Axela', 'Mazda5 Premacy', 'Mazda6 Atenza', 'Millenia', 'MPV', 'MX Series', 'Navajo', 'Porter', 'Premacy', 'Proceed', 'RX-7', 'RX-8 ', 'Sentia', 'Tracer', 'Tribute', 'Verisa', 'Xedos 6', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'MG Motors'  => ['children' => ['3', '6', '3S', 'GS', 'HS', 'RX 5', 'RX 8', 'ZS', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],
            'Mercedes-Benz'  => ['children' => ['190-Series', '200-Series', '300-Series', '400-Series', '500-Series', '600-Series', 'A-Class', 'AMG-Class', 'B-Class', 'C-Class', 'CLA-Class', 'CL-Class', 'CLK-Class', 'CLS-Class', 'E-Class', 'G-Class', 'GLA-Class', 'GLB-Class', 'GLC-Class', 'GL-Class', 'GL-Class', 'GLE-Class', 'GLK-Class', 'GLS-Class', 'Maybach S Series', 'M-Class', 'Metris', 'R-Class', 'S-Class', 'SL-Class', 'SLK-Class', 'SLR McLaren', 'SLS AMG', 'Sprinter', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'Mini'  => ['children' => ['Clubman', 'Convertible', 'Cooper', 'Countryman', 'Roadster', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Mitsubishi'  => ['children' => ['ASX', 'Challenger', 'Colt', 'Cordia', 'Delica', 'Eclipse', 'Endeavor', 'Evolution', 'Express', 'Galant', 'L200', 'Lancer', 'Minica', 'Mirage', 'Montero', 'Outlander', 'Pajero', 'Precis', 'Proudia', 'Raider', 'RVR', 'Triton', 'Zinger', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'Nissan'  => ['children' => ['Advan', 'Almera', 'Altima', 'Aprio', 'Armada', 'Avenir', 'Bluebird', 'Caravan', 'Cedric', 'Cefiro', 'Cima', 'Cube', 'Datsun', 'Dualis', 'Elgrand', 'Figaro', 'Frontier', 'Fuga', 'GT-R', 'Interstar', 'Juke', 'Lafesta', 'Latio', 'Laurel', 'Leaf', 'Liberty', 'March', 'Maxima', 'Micra', 'Mistral', 'Moco', 'Murano', 'Navara', 'Note', 'NV', 'NV Passenger', 'NX', 'Pathfinder', 'Patrol', 'Pino', 'Pixo', 'Prairie', 'President', 'Primera', 'Pulsar', 'Qashqai', 'Sentra', 'Serena', 'Silvia', 'Skyline', 'Sunny', 'Sylphy', 'Teana', 'Terra', 'Terrano', 'Tiida', 'Titan', 'Vanette', 'Versa', 'Wingroad', 'Xterra', 'X-Trail', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'Opel'  => ['children' => ['Combo', 'Monterey', 'VAUXHALL', 'Vivaro', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Peugeot'  => ['children' => ['208', '308', '508', '2008', '3008', '5008', '7008', 'Rifter', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Porsche'  => ['children' => ['718', '911', 'Cayenne', 'Macan', 'Panamera', 'Taycan', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Renault'  => ['children' => ['Arkana', 'Duster', 'Kaptur', 'Koleos', 'Scenic', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'Renaultsamsung' => ['children' => ['QM6', 'SM6', 'XM3', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Samsung'  => ['children' => ['SM3', 'SM5', 'SM7', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'1'],
            'SsangYong'  => ['children' => ['Actyon', 'Chairman', 'Istana', 'Korando', 'Kyron', 'Musso', 'Rexton', 'Rodius Stavic', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],
            'Skoda'  => ['children' => ['Enyaq', 'Fabia', 'Kamiq', 'Karoq', 'Kushaq', 'Octavia', 'Superb', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Subaru'  => ['children' => ['Exiga', 'Forester', 'Impreza', 'Legacy', 'Outback', 'Trezia', 'XT', 'XV Crosstrek', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'0'],
            'Suzuki'  => ['children' => ['Alto', 'Baleno', 'Escudo', 'Grand Vitara', 'Jimny', 'Kizashi', 'Maruti', 'Swift', 'Vitara', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'0'],
            'Toyota'  => ['children' => ['GT 86', '4Runner', 'Allex', 'Allion ', 'Alphard ', 'Aqua ', 'Auris ', 'Avensis ', 'bB', 'Belta', 'Cami', 'Camry ', 'Carina ', 'Chaser ', 'C-HR', 'Corolla', 'Corona', 'Cresta ', 'Crown', 'Duet', 'Estima ', 'EXIV', 'Fielder', 'FJ Cruiser', 'Gaia', 'Harrier ', 'Hiace ', 'Highlander ', 'Hilux ', 'Ipsum ', 'Isis ', 'Ist ', 'Kluger ', 'Land Cruiser 100', 'Land Cruiser 105', 'Land Cruiser 200', 'Land Cruiser 70', 'Land Cruiser 77', 'Land Cruiser 80', 'Land Cruiser Prado', 'Mark', 'Mark X Zio', 'Mark X ', 'Mark2', 'MR-2', 'Nadia', 'Noah ', 'Passo', 'Premio ', 'Prius 50', 'Prius C', 'Prius V', 'Prius-10 ', 'Prius-11 ', 'Prius-20 ', 'Prius-30 ', 'Prius-40,41 Alpha ', 'Probox ', 'Ractis ', 'Raum ', 'RAV4', 'Rumion', 'Runx', 'Rush ', 'Sai ', 'Sequoia', 'Sienta ', 'Spacio', 'Succeed', 'Tacoma ', 'Townace', 'Tundra ', 'Vanguard ', 'Vellfire ', 'Venza ', 'Verossa ', 'Vista', 'Vitz ', 'Voltz', 'Voxy ', 'WiLL', 'Wish ', 'Yaris', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'Tesla'  => ['children' => ['Caldina', 'Model S', 'Model X', 'Model Y', 'Roadster', 'Бусад'], 'normal'=>'1','truck'=>'0','bus'=>'0','special'=>'0'],
            'Volkswagen'  => ['children' => ['Amarok', 'Caddy', 'Golf', 'Jetta', 'Passat', 'Polo', 'Tiguan', 'Touareg', 'Touran', 'Transporter', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'0','special'=>'0'],
            'Volvo'  => ['children' => ['XC90', 'Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],
            'Бусад'  => ['children' => ['Бусад'], 'normal'=>'1','truck'=>'1','bus'=>'1','special'=>'1'],

            // Truck
            'BeiBen' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '1', 'special' => '0'],
            'CAMC' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'DAF' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '1'],
            'Daimler Group' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'Dongfeng' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '1'],
            'FAW' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '1'],
            'Foton' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '1', 'special' => '1'],
            'Hino' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '1', 'special' => '1'],
            'Hitachi' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '1'],
            'Iveco' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'JMC' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'KAMA' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'Kamaz' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '1', 'special' => '1'],
            'Mack' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'MAN' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '1', 'special' => '1'],
            'Navistar International' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'Paccar' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'Ram' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'RFW' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'Scania' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '1', 'special' => '1'],
            'Sinotruk' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '1', 'special' => '1'],
            'Tata' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '1', 'special' => '0'],
            'Tatra' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'Traton' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'UAZ' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'UD Trucks' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '1', 'special' => '0'],
            'Western Star' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'XCMG' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '1'],
            'Yulon' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'Ziyang Nanjun' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'ZX' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],
            'ЗИЛ' => ['children' => [], 'normal' => '0', 'truck' => '1', 'bus' => '0', 'special' => '0'],

            // Bus
            'Ankai' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Asiastar' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Baoding Changan Bus' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Changan' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Chongqing' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Daimler' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Federal' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Golden dragon' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Henan Shaolin' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Higer' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Hunan' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Jinbei' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'King Long' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Kingstar' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'PAZ' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Shanghai Shenlong bus' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Shenzhen Wuzhoulong Motors' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Sunlong' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Tata' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Yaxing' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Yutong' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Zhongtong' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'Zuhai' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],
            'ПАЗ' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '1', 'special' => '0'],

            // Special
            'Alpen' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Belarus' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Bobcat' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Caterpillar' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Cema' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Dayun' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Doosan' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Hangcha' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'JAC' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'JCB' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'John Deere' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Kobelco' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Komatsu' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Liebherr' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Lingong' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Liugong' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Lonking' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'North Benz' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Reddot' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Rubble master' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Sany' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'SDLG' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'SEM' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'SHAANXI' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Shacman' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Shandong' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Shantui' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Sinomach' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Sinotruk' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Sumitomo' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Sunward' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'TCM' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Terex' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'XGMA' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Xiamen' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Yugong' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Zil' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1'],
            'Zoomlion' => ['children' => [], 'normal' => '0', 'truck' => '0', 'bus' => '0', 'special' => '1']
        ];

        $carManufacturer = TaxonomyManager::register('Car Manufacturer', 'car', null, ['metaKey' => 'markName']);
        foreach ($marksModels as $mark => $models) {
            $markName = $mark;
            if ($markName == 'Бусад') {
                $markName = 'Busad';
            }
            $markTaxonomy = TaxonomyManager::register($mark, 'car-manufacturer', $carManufacturer->term->id, [
                'logo' => url(asset('images/manufacturers/' . \Str::slug($markName) . '.png')),
                'metaKey' => 'modelName'
            ], $models);
            if (array_key_exists('children', $models)) {
                foreach ($models['children'] as $model) {
                    TaxonomyManager::register($model, 'car-' . \Str::kebab($markName), $markTaxonomy->term->id);
                }
            }
            TaxonomyManager::updateTaxonomyChildrenSlugs($markTaxonomy->id);
        }
        TaxonomyManager::updateTaxonomyChildrenSlugs($carManufacturer->id);
    }
}
