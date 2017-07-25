<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Maps Controller
 *
 * @property \App\Model\Table\MapsTable $Maps
 */
class MapsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $fLat = !empty($this->request->query('lat')) ? $this->request->query('lat') : "28.633002996442908" ;
        $fLon = !empty($this->request->query('lon')) ? $this->request->query('lon') : "77.21985643017581" ;
        
        //$maps = $this->paginate($this->Maps);
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute("SELECT
        `id`,
        `name`,
        `descr`,
        `lat`,
        `lon`,
        ACOS( SIN( RADIANS( `lat` ) ) * SIN( RADIANS( $fLat ) ) + COS( RADIANS( `lat` ) )
        * COS( RADIANS( $fLat )) * COS( RADIANS( `lon` ) - RADIANS( $fLon )) ) * 6380 AS `distance`
        FROM `maps`
        WHERE
        ACOS( SIN( RADIANS( `lat` ) ) * SIN( RADIANS( $fLat ) ) + COS( RADIANS( `lat` ) )
        * COS( RADIANS( $fLat )) * COS( RADIANS( `lon` ) - RADIANS( $fLon )) ) * 6380 < 1
        ORDER BY `distance`");
        $maps = $stmt->fetchAll('assoc');
        //pr($maps); die;
        foreach($maps as $map){
            $map['distance'] = $this->distance('28.633002996442908', '77.21985643017581', $map['lat'], $map['lon']);
        }
        $this->set(compact('maps', 'fLat', 'fLon'));
        $this->set('_serialize', ['maps']);
    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit='K') {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    /**
     * View method
     *
     * @param string|null $id Map id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $map = $this->Maps->get($id, [
            'contain' => []
        ]);

        $this->set('map', $map);
        $this->set('_serialize', ['map']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $map = $this->Maps->newEntity();
        if ($this->request->is('post')) {
            $map = $this->Maps->patchEntity($map, $this->request->data);
            if ($this->Maps->save($map)) {
                $this->Flash->success(__('The map has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The map could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('map'));
        $this->set('_serialize', ['map']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Map id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $map = $this->Maps->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $map = $this->Maps->patchEntity($map, $this->request->data);
            if ($this->Maps->save($map)) {
                $this->Flash->success(__('The map has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The map could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('map'));
        $this->set('_serialize', ['map']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Map id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $map = $this->Maps->get($id);
        if ($this->Maps->delete($map)) {
            $this->Flash->success(__('The map has been deleted.'));
        } else {
            $this->Flash->error(__('The map could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    /**
     * Insert dummy database method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function insertDummy() {
        
        for($i = 0; $i < 100000; $i++ ){
            $data = $this->insertdummmyLogic();
            $map = $this->Maps->newEntity();
            $map = $this->Maps->patchEntity($map, $data);
            $this->Maps->save($map);
        }
        
        die("Done");
    }
    
    
    public function insertdummmyLogic() {
        $latStart = rand(28, 28).".".rand(1000000, 9999999);
        $lonStart = rand(77, 77).".".rand(1000000, 9999999);
        $locality = ["New Delhi", "Connaught Place", "Chanakyapuri", "Delhi Cantonment", "Vasant Vihar North Delhi", "Narela", "Model Town[3]", "Narela", "Alipur North West Delhi", "Kanjhawala", "Rohini", "Kanjhawala", "Saraswati Vihar West Delhi", "Rajouri Garden", "Patel Nagar", "Punjabi Bagh", "Rajouri Garden South West Delhi", "Dwarka", "Dwarka", "Najafgarh", "Kapashera South Delhi", "Saket", "Saket", "Hauz Khas", "Mehrauli South East Delhi", "Defence Colony", "Defence Colony", "Kalkaji", "Sarita Vihar Central Delhi", "Daryaganj", "Kotwali", "Civil Lines", "Karol Bagh North East Delhi", "Seelampur", "Seelampur", "Yamuna Vihar", "Karawal Nagar Shahdara", "Shahdara", "Shahdara", "Seemapuri", "Vivek Vihar East Delhi", "Preet Vihar", "Gandhi Nagar", "Preet Vihar", "Mayur Vihar"];
        $address = ["New DelhiNew Address New Address ", "Connaught PlaceNew Address New Address ", "ChanakyapuriNew Address New Address ", "Delhi CantonmentNew Address New Address ", "Vasant Vihar North DelhiNew Address New Address ", "NarelaNew Address New Address ", "Model Town[3]New Address New Address ", "NarelaNew Address New Address ", "Alipur North West DelhiNew Address New Address ", "KanjhawalaNew Address New Address ", "RohiniNew Address New Address ", "KanjhawalaNew Address New Address ", "Saraswati Vihar West DelhiNew Address New Address ", "Rajouri GardenNew Address New Address ", "Patel NagarNew Address New Address ", "Punjabi BaghNew Address New Address ", "Rajouri Garden South West DelhiNew Address New Address ", "DwarkaNew Address New Address ", "DwarkaNew Address New Address ", "NajafgarhNew Address New Address ", "Kapashera South DelhiNew Address New Address ", "SaketNew Address New Address ", "SaketNew Address New Address ", "Hauz KhasNew Address New Address ", "Mehrauli South East DelhiNew Address New Address ", "Defence ColonyNew Address New Address ", "Defence ColonyNew Address New Address ", "KalkajiNew Address New Address ", "Sarita Vihar Central DelhiNew Address New Address ", "DaryaganjNew Address New Address ", "KotwaliNew Address New Address ", "Civil LinesNew Address New Address ", "Karol Bagh North East DelhiNew Address New Address ", "SeelampurNew Address New Address ", "SeelampurNew Address New Address ", "Yamuna ViharNew Address New Address ", "Karawal Nagar ShahdaraNew Address New Address ", "ShahdaraNew Address New Address ", "ShahdaraNew Address New Address ", "SeemapuriNew Address New Address ", "Vivek Vihar East DelhiNew Address New Address ", "Preet ViharNew Address New Address ", "Gandhi NagarNew Address New Address ", "Preet ViharNew Address New Address ", "Mayur Vihar"];
        $localIndex = rand(0, count($locality));
        
        $data['name']   =       $locality[$localIndex];
        $data['descr']  =       $address[$localIndex];
        $data['lat']    =       $latStart;
        $data['lon']    =       $lonStart;
        
        return $data;
    }
}
