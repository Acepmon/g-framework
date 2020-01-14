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
            'Acura' => ['CDX','CL','CSX','ILX','Integra','Legend','RL','RDX','NSX','RLX','TSX','ZDX','Vigor','SLX','RSX','MDX','TLX','EL','TL'],
            'Alfa Romeo' => ['Brera','159','Alfetta','Spider','166','156','8C','MiTo','145','146','147','164','Arna','Giulia','Giulietta','GT','6C','Montreal','GTV6','Sprint','SZ','RL','155','GTA','GTC','GTV','TZ','TZ 2','Milano','GT Veloce','Duetto','Berlina','4C'],
            'Aston Martin' => ['DB11','DB7','DB9','DBS','Lagonda','One-77','Rapide','Vanquish','Vantage','Virage','Volante'],
            'Audi' => ['80','90','100','A1','A3','A4','A5','A6 Allroad Quattro','A7','A8','Allroad','Cabriolate','e-tron','Q3','Q5','Q7','R8','RS3','RS4','RS5','RS6','RS7','S3','S4','S5','S6','S7','S8','SQ5','TT','TTRS','TTS','V8'],
            'Bentley' => ['Arnage','Azure','Bentayga','Brooklands','Continental','Corniche','Eight','Flying Spur','Mulsanne','Turbo R'],
            'BMW' => ['1Series','2Series','3Series','4Series','5Series','6Series','7Series','8Series','Gran Turismo','i3','i8','M Coupe/Roadster','M2','M3','M4','M5','M6','X1','X2','X3','X3M','X4','X4M','X5','X6','X6M','X7','Z3','Z4','Z8'],
            'Bugatti' => ['Chiron','EB110','EB118','Veyron'],
            'Buick' => ['Regal','Cascada','Terraza','Excelle','Encore','Enclave','Envision','Roadmaster','Electra','Invicta','LeSabre','Riviera','Skylark','Reatta','Rendezvous','Rainier','Verano','Century','LaCrosse','Avenir','Avista','GL Series','Lucerne','Park Avenue','Velite'],
            'Cadillac' => ['DeVille','Seville','CT5','CT6','CTS','Eldorado','Catera','Brougham','ATS','Seville','DeVille','STS','DTS','Escalade','SRX','XLR','XT4','XT5','XT6','XTS','ELR','Allante','Calais'],
            'Chevrolet' => ['Astro','Avalanche','C-10','Cruze','Caprice','Chevy','Chevelle','Cobalt','Corvair','Corsica','Camaro','El Camino','Kodiak','HHR','Cavalier','Lumina','Monte Carlo','Omega','Orlando','Van','Aerovette','Aveo','Bel Air','Blazer','Equinox','Express','Impala','Malibu','Orlando','Colorado','Sequel','Silverado Truck','Sonic','Trax','Venture','Volt','Beretta','C/K Pickup','Cheyenne','Corvette','Explorer','Laguna','Montana','Omega','P10','P20','P30','Pickup','S-10','Scottsdale','Spark','SSR','Stepside','Suburban','Tahoe','Tavera','Tracker','Trailblazer','Traverse','Uplander','Winstorm'],
            'Chrysler' => ['200 Series','300 Series','Aspen','Atlantic','Caravan','Cirrus','Concode','Cordoba','Crossfire','Daytona','Fifth Avenue','Imperial','Intrepid','LeBaron','LHS','Nassau','Neon','New York','Newport','Pacifica','Prowler','PT Cruiser','Royal','Saratoga','Sebring','TC Maserati','TEVan','Town&Country','Vision','Voyager','Winsor'],
            'Citroen 2CV' => ['AX','Berlingo','BX','C1','C15','C2','C3','C4','C5','C6','C8','C-Crosser','C-ZERO','DS3','DS3 Crossback','DS4','DS5','DS6','DS7 Crossback','Elysee','Evasion','Fukang 988','Jumper','Jumpy','Nemo','Saxo','Synergie','Xantia','XM','Xsara','Xsara Picasso','ZX'],
            'Daewoo' => ['Lanos','Leganza','Magnus','Matiz','Nubira','Rezzo','Tosca'],
            'Dong Feng Motors' => ['ER30','Fengdu','Fengshen','Fengxin','Skio','Venucia'],
            'Daihatsu' => ['Altis','Applause','Ayla','Be-go','Boon','Cast','Ceria','Charade','Charade Centro','Charmant','Copen','Coste','Cuore','Delta','Demino','Esse','Fellow Max','Feroza','Fourtrak','Gran Move','Leeza','Luxio','Materia','Mebius','Mira','Mira Cocoa','Mira e:S','Mira Gino','Mira Tocot','Move','Move Conte','Move Latte','Naked','Opti','Pyzar','Rocky','Rugger','Sigra','Sirion','Sirion2','Sonica','Storia','Taft','Tanto','Terios','Thor','Trevis','Valera','Wake','Xenia','YRV'],
            'Dodge' => ['Aspen','A100','Avenger','Charger','Colt','Conquest','Challenger','Caliber','Magnum','Lancer','Stratus','Spirit','Coronet','Neon','Stealth','Viper','Dynasty','Caravan','Dakota','Dart','Daytona','Diplomat','Durango','Grand Caravan','Intrepid','Journey','Mirada','Monaco','Nitro','Polara','Power Wagon','Ram series','Ram Van','Ramcharger','Rampage','Rumble Bee','Shadow','Sprinter','Van','Venom'],
            'Faw' => ['Besturn','Dario','Haima','Hong Qi','Jiaxing','Jilin','Junpai','Oley','Senia','Sitech DEV1','Tianjin Vizi','Tianjin Weizhi Hatchback','Tianjin Weizhi Sedan','Tianjin Xiali N3','Tianjin Xiali N5','Tianjin iali N7','V2','V5','Vita'],
            'Ferrari' => ['360','456','458','488','550 Maranello','575M Maranello','599 GTB Fiorano','612 Scaglietti','812 Superfast','America','Ascari','California','Daytona','Dino','Enzo Ferrari','F12 TRS','F12berlinetta','F149','F355','F40','F430','F50','F60 America','F8','F80','FF','FXX','GG50','GTC4Lusso T','J50','LaFerrari','Millechili','Mondial','P4/5','P540','Pininfarina Sergio','Portofino','Roma','Rossa','Scuderio','Sergio','SF90','SP America','SP1','SP12 EC','SP275 RW','SP30 Arya','SP38','SP3JC','Superamerica','Testarossa','Zagato 575 GTZ'],
            'Fiat' => ['124 Spider','500 Series','Albea','Argo','Bravo','Croma','Cronos','Doblo','Ducato','Fiorino','Freemont','Grande Punto','Idea','Linea','Mobi','Ottimo','Panda','Punto','Sedici','Stilo','Tipo','Toro','Ulysse','Viaggio'],
            'Ford' => ['Aerostar','Aspire','Bronco','BroncoII','C600','C-Max','Contour','Cortina','Crestline','Crown Victoria','Edge','Escape','Escort','E-Series Van','Everest','Excursion','Expedition','Explorer','Fairlane','Fairmont','Falcon','Festica','Fiesta','Five Hundred','Flex','Focus','Ford GT','Freestar','F-Series Truck','Fusion','Galaxie','Gran Torino','Ka','Maverick','Model A','Model T','Mondeo','Mustang','Pickup','Probe','Ranchero','Ranger','Taurus','Taurus X','Tempo','Thunderbird','Torino','Transit','Transit Connect','Van','Verve','Windstar'],
            'Geely' => ['LC','Emgrand','Englon','GC9','GE Concept Car','Gleagle','LG King Kong','MK','Panda'],
            'Great Wall' => ['Coolbear','Deer','Florid','Haval F5','Haval F7','Haval H1','Haval H2','Haval H2S','Haval H4','Haval H5','Haval H6  ','Haval H6 Coupe','Haval H6 Sport','Haval H7','Haval H8','Haval H9','Haval M6','Hover','ORA iQ','ORA R1','Pao','Pegasus','Peri','Proteus','Safe','Sailor/SA220','Sing','SoCool','Voleex C10','Voleex C20R','Voleex C30','Voleex C50','Voleex V80','WEY P8','WEY VV5','WEY VV6','WEY VV7','WEY VV7 GT','Wingle 5'],
            'GMC' => ['Acadia','Autonomy Concept','Caballero','Canyon Truck','Chevette','Denali XT','Envoy','Granite','Graphyte','Graphyte Hybrid','Hy-Wire','Jimmy','Motorhome','PAD','Pickup','Safari','Savana','Sequel','Sierra Truck','Sonoma','Sprint','Suburban','Syclone','Terra 4','Terracross','Terradyne','Terrain','Tracker','Typhoon','Van','Vandura','Yukon'],
            'Honda' => ['Avancier','Ballade','Accord','BR-V','City','MC-β','Civic','Clarity FCX','Crider','Freed','Freed Spike','Elysion','Fit/Jazz','Fit Hybrid','Fit Shuttle','Mobilio','CR-V','CR-V S','Grace','Greiz','Hobio','Insight','Jade','Brio','Legend','Civic Type R','Civic Tourer','Gienia','Jazz RS','N-Box','N-Box Slash','Amaze','N-One','N-WGN','S660','Shuttle','Pilot','Odyssey','Passport','UR-V','Odyssey','Vezel','StepWGN','WR-V','XR-V','Ridgeline','e','NSX','N-Van','Spirior','Vamos','Accord Crosstour','Accord Euro','Accord Plug-in','Airwave','Capa','Civic Hybrid','Civic Natural Gas','Crossroad','Crosstour','CRX','CR-Z','CR-Z HPD','Del Sol','Edix','Element','EV Plus','FCX','Fit Aria','Fit Ev','FR-V','HR-V','Inspire','Integra','LaGreat','Life Dunk','Logo','Mobile Spike','Orthia','Partner','Prelude','S2000','Saber','S-MX','Stream','Thats','torneo','Vigor','Vision','Zest'],
            'Hyundai' => ['Accent','Tucson','Atoz','Elantra','Entourage','Grandeur','Genesis','Equus','Scoupe','Terracan','Tiburon','Trajet','Excel','Dynasty','Verna','Grace','Santa Fe','i30','Veracruz','Sonata','Galloper','Veloster','Lavita','Aslan','Avante','Azera','BlueOn','i40','IONIQ','Kona','Maxcruz','Nexo','Palisade','Solati','Sonata Hybrid','Starex','Trajet XG','Tuscani','Venue'],
            'Holden' => ['Acadia','Adventra','Apollo','Astra','Barina','Berlina','Calais','Calibra','Camira','Caprice','Captiva','Cascada','Colorado','Combo','Commodore','Corvette','Crewman','Cruze','Epica','Equinox','Frontera','Inignia','Jackaroo','Malibu','Monaro','Monterey','One Tonner','Rodeo','Spark','Statesman','Suburban','Tigra','TrailBlazer','Trax','Ute','Vectra','Viva','Volt','Zafira'],
            'Hummer' => ['H1','H2','H3','H3T'],
            'Isuzu' => ['Amigo','Ascender','Aska','Axiom','Bighorn','D-Max','Faster','Hombre','I Series','Impulse','MU','Oasis','Panther','Pickup','Rodeo','Stylus','Trooper','VehiCROSS','Wizard'],
            'Infiniti' => ['Q70','QX50','Q50','QX80','J30','Q30','I30 and I35','Q60','QX4','Q45','QX70','ESQ','QX60','Q40','QX30','EX Series','FX Series','G Series','JX','M35','M35h','M37','M56','QX56'],
            'Jaguar' => ['599 GTO','E-Type','F-Pace','F-Type','S-Type','XE','XF','XJ','XJ12','XJ6','XJ8','XJR','XJS','XK','XJ8','XKR','X-Type'],
            'Jeep' => ['Cherokee','Liberty','Gladiator','Commander','Compass','Commancho','Wagoneer','Patriot','CJ','Renegade','DJ','Wrangler','Grand Cheroke','Hurricane','Liberty Sport','Trailhawk'],
            'Kia' => ['K3','Seltos','Morning','Stonic','Carens','Soul','Stinger','Mohave','Ray','Sorento','Sportage','Pregio','Optima','Carnival','Forte','Rio','Pride','Carens','Forte','K5','K7','K9','Lotze','Niro','Opirus','Regal','Spectra','X-Trex'],
            'Kenbo' => ['H2V','H3','H6','S2','S3','S5','S6'],
            'Koenigsegg' => ['Agera','Agera Final','Agera Agera R','Agera RS','Agera S','CC','CC8s','CCGT','CCR','CCX','CCXR','Jesko','One','Quant','Regera','Trevita'],
            'Lamborghini' => ['Aventador','Centenario','Cointach','Diablo','Espada','Gallardo','Huracan','Murcielago','Superleggera','Urus'],
            'Lincolin' => ['Aviator','Blackwood','Continental','Corsair','LS','Mark LT','Mark Series','MKC','MKS','MKT','MKX','MKZ','MKZ Hybrid','Nautilus','Navigator','Town Car'],
            'Lotus' => ['Carlton','Elan','Elise','Esprit','Europa','Evija','Evora 400','Exige'],
            'Land Rover' => ['Defender','Discovery','Discovery Sport','Freelander','Land Rover','LR3','LR4','LR2','Range Rover','Range Rover Evoque','Range Rover Sport','Range Rover Velar'],
            'Lexus' => ['CT 200h','ES','ES Hybrid','GS','GS F','GX','HS','HS Hybrid','IS','IS F','LC','LC Hybrid','LFA','LS','LS Hybrid','LX','NX','NX Hybrid','RC','RC F','RX','RX Hybrid','SC','UX','UX Hybrid'],
            'Maserati' => ['Coupe','Ghibli','Gransport','HranTurismo','Levante','Quattroporte','Spyder'],
            'Mazda' => ['323','626','929','Attenza','AZ-1','AZ-Offroad','Biante','Bongo','B-Series Pickup','BT-50','Cronos','CX Series','Demio','Eunos','Familia','Kabura','Laputa','Mazda2 Demio','Mazda3 Axela','Mazda5 Premacy','Mazda6 Atenza','Mazdaspeed','Millenia','MPV','MX Series','Navajo','Porter','Premacy','Premacy Hydrogen RE Hybrid','Proceed','Protégé','RX-7','RX-8','Sentia','Tracer','Tribute','Tribute Hybrid','Verisa','Xedos 6'],
            'McLaren' => ['570GT','540C Coupe','570S','600LT','625C','650S','675LT','720S','F1','MP4-12C','P1'],
            'Maybach' => ['57','62','57 Zeppelin','57S','62 Landaulet','62 Zeppelin','62S','Exelero','Mercedes-Maybach G650','Mercedes-Maybach GLS600','Mercedes-Maybach S500','Mercedes-Maybach S560','Mercedes-Maybach S600','Mercedes-Maybach S600 Pullman','Mercedes-Maybach S650'],
            'MG' => ['3','6','3S','GS','HS','RX5','ZS'],
            'Mercury' => ['Capri','Grand Marques','Mariner','Milan','Montego','Monterey Convenience','Mountaineer','Sable','Villager'],
            'Mercedes Benz' => ['190-Series','200-Series','300-Series','400-Series','500-Series','600-Series','A-Class','AMG-Class','C-Class','CLA-Class','CL-Class','CLK-Class','CLS-Class','E-Class','G-Class','GLA-Class','GLB-Class','GLC-Class','GL-Class','GLE-Class','GLK-Class','GLS-Class','Maybach S Series','M-Class','Metris','R-Class','S-Class','SL-Class','SLK-Class','SLR McLaren','SLS AMG','Sprinter'],
            'Mini' => ['Classic','Clubman','Convertible','Cooper','Cooper S','Countryman','Coupe','E Countryman','Hardtop','Hatch','John Cooper Works','MK I Cooper','MK II Cooper','Moke','Paceman','Roadster','Rover Mini'],
            'Mitsubishi' => ['380','3000GT','Airtrek','ASX','Attrage','Carisma','Chariot','Colt','Colt Plus','Cordia','Delica','Diamante','Dingo','Dion','Eclipse','Eclipse Cross','eK','Endeavor','Evolution','Expo','Eye','Freeca','FTO','Galant','Grandis','GTO','i-MiEV','L200','Lancer','Lancer evolution','Magna','Maven','Mighty Max','Minica','Mirage','Montero','Outlander','Pajero','Pajero iO','Pajero Mini','Pajero Sport','Pistachio','Precis','Proudia','Raider','RVR','Sarvin','Sigma','Space Star','Starion','Toppo','Town Box','Tredia','Triton','Xpander','Zinger'],
            'Nissan' => ['180SX','200SX','240SX','280ZX','300ZX','350Z','370Z','370Z Nismo','370Z Roadster','AD','Almera','Altima','Aprio','Armada','Atlas','Atleon','Avenir','Axxess','Bassare','Bluebird','Cabstar','Camiones','Caravan','Cedric','Cefriro','Cima','Cliffer','Cube','Datsun','Dayz','Desu','Dualis','Elgrand','Fairlady z','Figaro','Frontier','Fuga','Grand Livina(Livina Geniss)','GT-R','Hardbody','Interstar','Joy','Juke','Kicks','Kix','Kubistar','Lafesta','Largo','Latio','Laurel','Leaf','Liberty','Livina','Lucino','March','Maxima','Micra','Mistral','Moco','Murano','Navara','Note','NP200','NP300','NV','NV Cargo NV3500 HD','NV Passenger NV3500 HD','NV100','NV1500','NV200','NV2500','NV300','NV350','NV400','NX','Otti','Pao','Pathfinder','Patrol','Pickup','Pino','Pixo','Platina','Prairie','Presage','President','Primaster','Primera','Pulsar','Qashqai','Quest','Rasheen','Rnessa','Rogue','Rogue Htbrid','Rogue Sport','Roox','Sentra','Serena','Silvia','Skyline','Stagea','Stanza','Sunny','Sylphy','Teana','Terra','Terrano','Tiida','Tino','Titan','Tsubame','Tsuru','Urvan','Vanette','Versa','Versa Note','Wingroad','Xterra','X-Trail'],
            'Opel' => ['Adam','Agila','Ampera','Antara','Astra','Blazer','Cabrio','Calais','Cascada','Corsa','Crossland X','Grandland X','Insigna','Karl','Meriva','Mokka','Monterey','Omega','Signum','Sintra','Speedster','Tigra','Vectra','Zafira'],
            'Oldsmobile' => ['Alero','Aurora','Bravada','Cutless Ciera','Intrigue','Silhoutte'],
            'Pontiac' => ['Aztek','Bonneville','Fiero','Firebird','G3','G5','G6','G8','Grand am','Grand prix','GTO','Le Mans','Montana','Safari','Solstice','Sunbird','Sunfire','Tempest','Torrent','Trans Am','Transport','Ventura','Vibe'],
            'Peugeot' => ['106','107','205','206','207','208','301','306','307','308','405','406','407','505','508','605','607','806','807','1007','3008','4007','Expert','Partner','RCZ','Type 66'],
            'Porsche' => ['312','356','695','718','901','911','912','914','916','918','924','928','930','942','944','959','968','969','989','108F','911 Carrera','911 Targa','AP Series','Boxster','C88','Carrera GT','Cayenne','Cayman','Junier(14hp)','Macan','Master(50hp)','Panamera','Panamericana','R22','Roxster','Speedster','Standard(25hp)','Super(38hp)','Taycan','Type110'],
            'Renault' => ["Alaskan","Arkana","Clio V","Dacia","Dokker","Duster","Duster Oroch","Euro clio","Espace V","Fluence","Kadjar","Kangoo II","Kangoo Express","Kaptur","Koleos","Kwid","Laguna","Latitude","Lodgy","Logan","Logan Stepway","Master","Mégane","Mégane IV","Safrane","Sandero","Sandero Stepway","Sandero Stepway City","Scénic","Symbol","Talisman","Trafic","Triber","Twingo III","Twizy","Zoe"],
            'Rolls Royce' => ['Cullinan','Dawn','Drophead Coupe','Hyperion','Phantom','Silver Seraph','Wraith'],
            'Ram' => ['1500','2500','3500','Cargo','Chassis Cab','Promaster','Promaster City'],
            'Saab' => ['96','99','900','9000','9-3','9-2X','9-7X','9-5','9-4X','Sonett'],
            'Saturn' => ['Astra','Aura','Curve','Ion','L-Series','Outlook','Relay','Sky','S-Series','Vue'],
            'Scion' => ['FR-S','iA','iM','iQ','tC','xA','xB','xD'],
            'SsangYong' => ['Actyon','Chairman','Istana','Korando','Kyron','Musso','Rexton','Rodius','Tivoli','Transstar','Kallista'],
            'Samsung' => ['Clio','Master','QM','QM5','QM6','SM3','SM5','SM6','SM7','Twizy'],
            'Smart' => ['Brabus Forfour','Brabus Fortwo','Brabus Fortwo Cabrio','Brabus tailor Made','Cabrio Tailor Made','Crossblade','Edition #1','EQ Forfour','EQ Fortwo','EQ Fortwo Cabrio','Forfour','Formore','Fortwo','Fortwo abrio','Fortwo Electric Drive','Fortwo Special Models','Roadster'],
            'Skoda' => ['Fabia','Felica','Kodiaq','Octavia','Rapid','Roomster','Superb','Yeti'],
            'Subaru' => ['Ascent','B9','Baja','Bighorn','BRZ','Crosstrek','DL','Exiga','Forester','GL','Impreza','Justy','Legacy','Levorg','Loyale','Lucra','Other','Outback','Pleo','R1','R1e','R2','Stella','STI','Sumo','SVX','Traviq','Trezia','Tribeca','Vivio','WRX','XT','XV'],
            'Suzuki' => ['Aerio','Alto','APV','Baleno','Celerio','Ciaz','Cultus','Equator','Ertiga','Escudo','Esteem','Forenza','Grand Vitara','Hustler','Ignis','Jimny','Karimun','Kei','Kizashi','Landy','Lapin','Maruti','MR Wagon','Palette','Reno','Samurai','Sidekick','Spacia','Splash','Swift','SX4','SX4','Twin','Verona','Vitara','wagon R','X-90','XL7'],
            'Toyota' => ['86','4Runner','Allex','Allion','Alphard','Altezza','Aqua','Auris','Avalon','Avanzo','Avensis','Aygo','bB','Belta','Brevis','Caldina','Cami','Camry','Carina','Celica','Celsior','Chaser','C-HR','Corolla','Corolla Axio','Corolla Fielder','Corolla Rumion,','Corolla Runx','Corolla Spacio','Corona','Corsa','Cressida','Cresta','Corolla Spacio','Crown','Duet','Echo','Fielder','Estima','Fortuner','Gaia','Harrier','Hiace','Highlander,','Hilux','Ipsum','Isis','Ist','Kluger','Land Cruiser-100','Land Cruiser-105','Land Cruiser-200','Land Cruiser-70','Land Cruiser-80','Land Cruiser Prado-120','Land Cruiser Prado-150','Land Cruiser Prado-95','Mark2','Mark X','Mark X Zio','Noah','Passo','Passo Settle,','Premio','Prius-10','Prius-11','Prius-20','Prius-30','Prius-40,41 Alpha','Probox','Progres','Ractis','Raum','Rav4','Rush','Sai','Sienta','Succeed','Tacoma,','Tundra','Vanguard','Vellfire','Venza','Verossa','Vitz','Voxy','Wish','Fj Cruiser','Funcargo','GR Supra','IQ','Land Cruiser 77','Land Cruiser Prado','Land Cruiser Prado-70','Mark','Matrix','Mega Cruiser','Mirai','MR-2','MR-S','Nadia','Pickup','Platz','Porte','Previa','Prius 50','Prius C','Prius V','Rumion','Runx','Sequoia','Sera','Sienna','Soarer','Solara','Spacio','Sprinter','Supra','T100','Tercel','Townace','Van','Vista','Voltz','WiLL','Windom','Yaris','Yaris iA'],
            'Tesla' => ['Caldina','Model 3','Model S','Model X','Model S','Model Z','Roadster'],
            'Volkswagen' => ['1600','Amarok','Ameo','Arteon','Atlas','Beetle','Beetle - Classic','Beetle-New','Cabrio','Cabriolet','Caddy','California','CC','Corrado','Eos','EuroVan','Fox','GLI','Gol','Golf','GTI','ID.3','Jetta','Karmann Ghia','Lamando','Lavida','LT','Lupo','Microbus','New eetle','Passat','Phaeton','Polo','R32','Rabbit','Routan','Santana','Scirocco','Sharan','SportWagen','Squareback','T-Cross','Thing','Tiguan','Touareg','Touran','Transporter','T-Roc','Type III','Up','Van ','Vanagon','Vento','XL 1'],
            'Volvo' => ['164','240','740','760','780','850','940','960','C30','C70','GL','S40','S60','S70','S80','S90','V40','V50','V60','V70','V90','XC (Cross Country)','XC40','XC60','XC70','XC90'],
            'Uaz' => ['39294','450/452','Bars-3159','Cargo','Jaguar','Patriot','Simba-3165','Simbir-3162','Sport-3150','Trekol-39294'],
            'Zil' => ['ZIS-101','ZIS-102','ZIS-110','ZIS-115','ZIL-MZ','ZIL-111','ZIL-111G','ZIL-114','ZIL-115','ZIL-117','ZIL-4102','ZIL-4104','ZIL-4105','ZIL-41041','ZIL-41042','ZIL-41044','ZIL-41045','ZIL-41047','ZIL-41072','ZIL-4112R','ZIS-101','ZIS-110','ZIL-111V','ZIL-111G','ZIL-114','ZIL-117','ZIL-41041','ZIL-41044','ZIL-41047','ZIL-4112R','Trucks','ZIL 130','ZIL 5301','ZIL 4331','fire truck AC 3.2-40 (ZiL-4331)','fire truck AC 3,0-40 (ZiL-4334)','AMO-F-15','ru:АМО-2','AMO-3','AMO-7','ZIS-5, ZIS-6','ZIS-10','ZIS-11','ZIS-12','ZIS-13','ZIS-14','ZIS-15','ZIS-21','ZIS-22','ZIS-23','ZIS-24','ZIS-30','ZIS-32','ZIS-33','ZIS-36','ZIS-41','ZIS-42','ZIS-43','ZIS-50','ZIS-120N','ZIS-121','ZIS-128','ZIS-E134','ZIS-150','ZIS-151','ZIS-153','ZIS-156','ZIS-253','ZIS-585','ZIL-130','ZIL-131','ZIL-132','ZIL-133','ZIL-134','ZIL-135','ZIL-136','ZIL-137','ZIL-138','ZIL-157','ZIL-157R','ZIL-164','ZIL-164N','ZIL-165','ZIL-166','ZIL-E-167','ZIL-169G','ZIL-E169A','ZIL-170','ZIL-175','ZIL-485','ZIL-553','ZIL-555','ZIL-585','ZIL-2502','ZIL-3302','ZIL-3906','ZIL-4305','ZIL-4327','ZIL-4331','ZIL-4334','ZIL-4514','ZIL-4972','ZIL-5301 "Bychok"','ZIL-5901','ZIL-6404','ZIL-6309','ZIL-6409','ZIL-432720','ZIL-432930','ZIL-433180','ZIL-436200'],
            'AEV' =>[''],
            'Agrale' =>[''],
            'Albion' =>[''],
            'AM General' =>[''],
            'Amico Azar Motor Industrial Co' =>[''],
            'Amur' =>[''],
            'AMW' =>[''],
            'Argyle' =>[''],
            'Armstrong' =>[''],
            'Ashok Leyland' =>[''],
            'Asia MotorWorks (AMW)' =>[''],
            'Askam' =>[''],
            'Astra' =>[''],
            'Atkinson' =>[''],
            'Autocar' =>[''],
            'Avia Trucks' =>[''],
            'AVM' =>[''],
            'AvtoVAZ' =>[''],
            'AWD' =>[''],
            'Az Universal Motors' =>[''],
            'Ankai' =>[''],
            'Arboc' =>[''],
            'Ashok' =>[''],
            'Ace' =>[''],
            'Aichi' =>[''],
            'Atlas' =>[''],
            'Bailey' =>[''],
            'BAW' =>[''],
            'Beau-Roc' =>[''],
            'BeiBen' =>[''],
            'Beijing Automobile Works(BAW)' =>[''],
            'BelAZ','BEML','Bering rucks' =>[''],
            'BharatBenz' =>[''],
            'BMC' =>[''],
            'Brabus' =>[''],
            'Bremach' =>[''],
            'Brockway' =>[''],
            'Büssing' =>[''],
            'BYD' =>[''],
            'Belarus' =>[''],
            'Bobcat' =>[''],
            'Bomag' =>[''],
            'Company' => [''],
            'C&C' => [''],
            'Callaway' => [''],
            'CAMC' => [''],
            'Carmichael' => [''],
            'CCC' => [''],
            'Cenntro' => [''],
            'CEV' => [''],
            'Chery' => [''],
            'CNJ' => [''],
            'Colet' => [''],
            'Crane Carrier Corporation (CCC)' => [''],
            'Champion' => [''],
            'Changan' => [''],
            'Ciferal' => [''],
            'Cobus' => [''],
            'Collins' => [''],
            'Case' => [''],
            'CAT' => [''],
            'Caterpillar' => [''],
            'Cathefeng' => [''],
            'Cema' => [''],
            'Changlin' => [''],
            'Cummins' => [''],
            'DAC' => [''],
            'Dacia' => [''],
            'Dadi' => [''],
            'Dart' => [''],
            'Dennis' => [''],
            'Dennison' => [''],
            'Diamond T' => [''],
            'Dina' => [''],
            'Daimler' => [''],
            'Daf' => [''],
            'Dayun' => [''],
            'DEMAG' => [''],
            'Doosan' => [''],
            'Dynapac' => [''],
            'Ebro' => [''],
            'ERF' => [''],
            'Euclid Trucks' => [''],
            'Eicher'=> [''],
            'Eldorado'=> [''],
            'Enc'=> [''],
            'Everdigm'=> [''],
            'FAP'=> [''],
            'Fassi'=> [''],
            'Flextruc'=> [''],
            'Foden'=> [''],
            'Forland'=> [''],
            'Freightliner'=> [''],
            'FTF Trucks'=> [''],
            'Federal'=> [''],
            'Force'=> [''],
            'Fayat'=> [''],
            'Foton'=> [''],
            'Furukawa'=> [''],
            'Fuso'=> [''],
            'Garner'=> [''],
            'Garrett'=> [''],
            'General Motors'=> [''],
            'Genoto'=> [''],
            'Gilford'=> [''],
            'GINAF'=> [''],
            'Gonow'=> [''],
            'Gräf & Stift'=> [''],
            'Greenkraft Inc'=> [''],
            'GAZO'=> [''],
            'Gillig'=> [''],
            'Golden dragon'=> [''],
            'Goshen'=> [''],
            'Hafei'=> [''],
            'Haulamatic'=> [''],
            'Hayes Truck'=> [''],
            'Hendrickson'=> [''],
            'Hindustan Motors'=> [''],
            'Hino'=> [''],
            'Hitachi'=> [''],
            'Hohan'=> [''],
            'Hongyan'=> [''],
            'HSV'=> [''],
            'Hualing Xingma Automobile' => [''],
            'Henan Shaolin' => [''],
            'Higer' => [''],
            'Hino' => [''],
            'Huazhong' => [''],
            'Hunan' => [''],
            'Halla' => [''],
            'Hamm' => [''],
            'Hanix' => [''],
            'HBXG' => [''],
            'Heli' => [''],
            'Hino' => [''],
            'Hitachi' => [''],
            'International' => [''],
            'Iran Khodro' => [''],
            'Iveco' => [''],
            'Irisbus Iveco' => [''],
            'IHI' => [''],
            'Isuzu' => [''],
            'Infiniti' => [''],
            'JAC' => [''],
            'JAC Motors(Anhui Jianghuai Automobile)' => [''],
            'Jiangling' => [''],
            'JMC' => [''],
            'J-Bus' => [''],
            'Jiangsu Alpha' => [''],
            'Jcb' => [''],
            'Jingong' => [''],
            'John Deere' => [''],
            'Karry' => [''],
            'Kenworth' => [''],
            'King Long' => [''],
            'Kingstar' => [''],
            'Krystal' => [''],
            'Ksir' => [''],
            'Kamaz' => [''],
            'Kato' => [''],
            'Kawasaki' => [''],
            'Kobelco' => [''],
            'Komatsu' => [''],
            'Kraz' => [''],
            'Kubota' => [''],
            'Leader Trucks' => [''],
            'Leyland' => [''],
            'Lincoln' => [''],
            'Liuzhou motor' => [''],
            'Lomont' => [''],
            'Liaz' => [''],
            'L&T' => [''],
            'Lgmg' => [''],
            'Liebherr' => [''],
            'Linuo' => [''],
            'Liugong' => [''],
            'Lonking' => [''],
            'Lovol' => [''],
            'Mack' => [''],
            'Mahindra' => [''],
            'MAN' => [''],
            'Marmon' => [''],
            'Master' => [''],
            'Maxus' => [''],
            'MAZ(Minsk Automobile Plant)' => [''],
            'Multicar' => [''],
            'MZKT' => [''],
            'Mahindra' => [''],
            'MAN' => [''],
            'Marcopolo' => [''],
            'Muran' => [''],
            'MV-1' => [''],
            'Man' => [''],
            'Manitowoc' => [''],
            'Meiwa' => [''],
            'Morooka' => [''],
            'Navistar International' => [''],
            'New entosa CV' => [''],
            'Nanjing' => [''],
            'Nor-Cal Vans' => [''],
            'N.Traffic' => [''],
            'New Holland' => [''],
            'North Benz' => [''],
            'OAF' => [''],
            'Orange EV' => [''],
            'Oshkosh' => [''],
            'Otokar' => [''],
            'Paccar' => [''],
            'Pegaso' => [''],
            'Perkasa Truck' => [''],
            'Perlini' => [''],
            'Persika' => [''],
            'Peterbilt' => [''],
            'Polarsun' => [''],
            'Proton' => [''],
            'PAZ' => [''],
            'Proterra' => [''],
            'Qingling' => [''],
            'Ralph' => [''],
            'Rivian' => [''],
            'Roman' => [''],
            'Reddot' => [''],
            'Rightchoice' => [''],
            'SAIC-Iveco Hongyan' => [''],
            'SAIPA' => [''],
            'Saleen' => [''],
            'Saviem' => [''],
            'SCAM' => [''],
            'SD' => [''],
            'Sentinel' => [''],
            'Shaanxi' => [''],
            'Shacman' => [''],
            'Shangdong Wuzheng Group' => [''],
            'Shelby','Silant','Sisu' => [''],
            'Sitom' => [''],
            'Sitrak' => [''],
            'Smith' => [''],
            'SNVI' => [''],
            'Star' => [''],
            'Steyr' => [''],
            'Shenzhen Wuzhoulong motors Group' => [''],
            'SML Isuzu' => [''],
            'Solaris' => [''],
            'Sunlong' => [''],
            'Suzhou' => [''],
            'Sakai' => [''],
            'Sany' => [''],
            'Scania' => [''],
            'Schaeff' => [''],
            'SDLG' => [''],
            'Sem' => [''],
            'Shacman' => [''],
            'Shandong' => [''],
            'Shantui' => [''],
            'Sinomach' => [''],
            'Sinotruk' => [''],
            'Sonstige' => [''],
            'Sumitomo' => [''],
            'Sunward' => [''],
            'Tatra' => [''],
            'TAV' => [''],
            'Terberg' => [''],
            'Tiger Truck' => [''],
            'Tonar' => [''],
            'TVS' => [''],
            'Tata' => [''],
            'Temsa' => [''],
            'Trans Tech Buses' => [''],
            'Turbus' => [''],
            'Turtle Top Buses' => [''],
            'Tadano' => [''],
            'Taian Zhengtai' => [''],
            'TCM' => [''],
            'Terex' => [''],
            'Triton Valves' => [''],
            'Tym' => [''],
            'Union' => [''],
            'UralAZ' => [''],
            'Uri' => [''],
            'UD Trucks' => [''],
            'Universal' => [''],
            'Vauxhall' => [''],
            'Vehicle Factory Jabalpur (VFJ)'=> [''],
            'VDL'=> [''],
            'Vision Bus'=> [''],
            'Volare'=> [''],
            'Volgren'=> [''],
            'Vogele'=> [''],
            'Western Star'=> [''],
            'Workhorse'=> [''],
            'World Trans'=> [''],
            'Wecan'=> [''],
            'Wirtgen'=> [''],
            'XCMG'=> [''],
            'XGMA'=> [''],
            'Xiajin'=> [''],
            'Yarovit'=> [''],
            'Yuejin'=> [''],
            'Yulon'=> [''],
            'Yaxing'=> [''],
            'Yutong'=> [''],
            'Yanmar'=> [''],
            'Yongmao'=> [''],
            'YTO'=> [''],
            'Yugong'=> [''],
            'Zastava'=> [''],
            'Ziyang Nanjun'=> [''],
            'ZX'=> [''],
            'Zhongtong Bus'=> [''],
            'Zuhai'=> [''],
            'Zoomlion'=> ['']
            
            // 'Trucks' => ['AEV','Agrale','Albion','Alfa Romeo','AM General','Amico Azar Motor Industrial Co','Amur','AMW','Argyle','Armstrong','Ashok Leyland','Asia MotorWorks (AMW)','Askam','Astra','Atkinson','Audi','Autocar','Avia Trucks','AVM','AvtoVAZ','AWD','Az Universal Motors','Bailey','BAW','Beau-Roc','BeiBen','Beijing Automobile Works(BAW)','BelAZ','BEML','Bering rucks','BharatBenz','BMC','BMW','Brabus','Bremach','Brockway','Büssing','BYD Company ','C&C','Cadillac','Callaway','CAMC','Carmichael','Caterpillar ','CCC','Cenntro','CEV','Changan','Chery','Chevrolet','Chrysler','Citroen','CNJ','Colet','Crane Carrier Corporation (CCC)','DAC','Dacia','Dadi','Daewoo','DAF Trucks','Daihatsu','Daimler Group','Dart','Dayun','Dennis','Dennison','Diamond T','Dina','Dodge','Dongfeng','Ebro','Eicher Motors','ERF','Euclid Trucks','FAP','Fassi','FAW','Ferrari','Fiat','Flextruc','Foden ','Force Motors','Ford','Forland','Foton','Freightliner','FTF Trucks','Garner','Garrett','GAZ','General Motors(GM)','Genoto','Gilford','GINAF','GMC','Gonow','Gräf & Stift','Great Wall','Greenkraft Inc','Hafei','Haulamatic','Hayes Truck','Hendrickson','Hindustan Motors ','Hino','Hitachi','Hohan','Holden','Honda','Hongyan','HSV','Hualing Xingma Automobile','Hummer','Hyundai','Infinite','International','Iran Khodro','Isuzu','Iveco','JAC','JAC Motors(Anhui Jianghuai Automobile)','Jeep','Jiangling','JMC','Kamaz','Karry','Kenworth','Kia','Komatsu','KrAZ','Lamborghini','Land Rover','Leader Trucks','Lexus','Leyland','Liebherr Group','Lincoln','Liuzhou motor','Lomont','Mack','Mahindra','MAN','Marmon','Master','Maxus','MAZ(Minsk Automobile Plant)','Mazda','Mercedes-Benz','MG Motors','Mini','Mitsubishi','Multicar','MZKT','Navistar International','New entosa CV','Nissan','OAF','Orange EV','Oshkosh','Otokar','Paccar','Pegaso','Perkasa Truck','Perlini','Persika','Peterbilt','Peugeot','Polarsun','Pontiac','Proton','Qingling','Ralph ','Ram','Renault','Rivian','Roman','SAIC-Iveco Hongyan','SAIPA','Saleen','Saviem','SCAM','Scania','SD','Sentinel','Shaanxi','Shacman','Shangdong Wuzheng Group','Shelby','Silant','Sinotruk','Sisu','Sitom','Sitrak','Skoda','Smith','SML Isuzu','SNVI','SsangYong','Star','Steyr','Subaru','Suzuki','Tadano','Tata','Tatra','TAV','Terberg','Terex','Tesla Motors','Tiger Truck','Tonar','Toyota','TVS','UAZ','UD Trucks','Union','UralAZ','Uri','Vauxhall','Vehicle Factory Jabalpur (VFJ)','Volkswagen','Volvo Trucks','Western Star','Workhorse','XCMG','Yarovit','Yuejin','Yulon','Zastava','Ziyang Nanjun','ZX'],
            // 'Bus' => ['Ankai','Arboc','Ashok Leyland','Asiastar','BharatBenz','BYD','Champion','Changan','Ciferal','Cobus','Collins','Daewoo','Daihatsu','Daimler','Dongfeng','Eicher','Eldorado','Enc','Federal','Force','Ford','Foton','GAZ OAO','Gillig','Golden dragon','Goshen','Henan Shaolin','Higer','Hino','Honda','Huazhong','Hunan','Hyundai','Irisbus Iveco','Isuzu','J-Bus','Jiangsu Alpha','Kamaz','Kia','King Long','Kingstar','Krystal','Ksir','Liaz','Mahindra','MAN','Marcopolo','Mazda','Mercedes-Benz','Mitsubishi','Muran','MV-1','Nanjing','Nissan','Nor-Cal Vans','PAZ','Proterra','Scania','Shenzhen Wuzhoulong otors Group','Sinotruk','SML Isuzu','Solaris','Ssangyong','Subaru','Sunlong','Suzhou','Suzuki','Tata','Temsa','Toyota','Trans Tech Buses','Turbus','Turtle Top Buses','UD Trucks','VDL','Vision Bus','Volare','Volgren','Volvo','World Trans','Yaxing','Yutong','Zhongtong Bus','Zuhai'],
            // 'Heavy' => ['Ace','Aichi','Atlas Copco','Belarus','Bobcat','Bomag','Case','CAT','Caterpillar','Cathefeng','Cema','Changlin','Cummins','Daewoo','Daf','Dayun','DEMAG','Dongfeng','Doosan','Dynapac','Everdigm','Faw','Fayat','Foton','Furukawa','Fuso','Halla','Hamm','Hanix','HBXG','Heli','Hino','Hitachi','Hyundai','IHI','Isuzu','Jcb','Jingong','John Deere','Kamaz','Kato','Kawasaki','Kia','Kobelco','Komatsu','Kraz','Kubota','L&T','Lgmg','Liebherr','Linuo','Liugong','Lonking','Lovol','Man ','Manitowoc','Mazda','Mazda','Meiwa','Mercedes-Benz','Mitsubishi','Morooka','N.Traffic','New Holland','Nissan','North Benz','Reddot','Renault','Rightchoice','Sakai','Samsung','Sany','Scania','Schaeff','SDLG','Sem','Shacman','Shandong','Shantui','Sinomach','Sinotruk','Sonstige','Ssangyong','Sumitomo','Sunward','Tadano','Taian Zhengtai','TCM','Terex','Toyota','Triton Valves','Tym','Universal','Vogele','Volvo','Wecan','Wirtgen','XCMG','XGMA','Xiajin','Yanmar','Yongmao','YTO','Yugong','Zil','Zoomlion']
        ];

        $carManufacturer = TaxonomyManager::register('Car Manufacturer', 'car', null, ['metaKey' => 'markName']);
        foreach ($marksModels as $mark => $models) {
            $markTaxonomy = TaxonomyManager::register($mark, 'car-manufacturer', $carManufacturer->term->id, [
                'logo' => url(asset('images/manufacturers/' . \Str::slug($mark) . '.png')),
                'metaKey' => 'modelName'
            ]);
            foreach ($models as $model) {
                TaxonomyManager::register($model, 'car-' . \Str::kebab($mark), $markTaxonomy->term->id);
            }
            TaxonomyManager::updateTaxonomyChildrenSlugs($markTaxonomy->id);
        }
        TaxonomyManager::updateTaxonomyChildrenSlugs($carManufacturer->id);
    }
}
