<?php

$app->post('/api/GoogleGeocodingAPI/getAddressComponents', function ($request, $response, $args) {
    $settings =  $this->settings;
    
    $data = $request->getBody();
    $post_data = json_decode($data, true);
    if(!isset($post_data['args'])) {
        $data = $request->getParsedBody();
        $post_data = $data;
    }
    
    $error = [];
    if(empty($post_data['args']['apiKey'])) {
        $error[] = 'apiKey cannot be empty';
    }
    if(empty($post_data['args']['address'])) {
        $error[] = 'address cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $query['key'] = $post_data['args']['apiKey'];
    $query['address'] = $post_data['args']['address'];
    
    $query_str = 'https://maps.googleapis.com/maps/api/geocode/json';
    
    $client = $this->httpClient;

    try {

        $resp = $client->get( $query_str, 
            [
                'query' => $query
            ]);
        $responseBody = $resp->getBody()->getContents();
        $code = $resp->getStatusCode();
        $res = json_decode($responseBody);
        
        if(!empty($res) && $code == '200') {
            
            if($res->status == 'ZERO_RESULTS') {
                $result['callback'] = 'addressNotFound';
                $result['contextWrites']['to'] = 'Address not found';
            } elseif($res->status == 'OK') {
                $section = $res->results[0]->address_components;
                $out = [];
                foreach($section as $key=>$item) {
                    $name = $item->long_name;
                    $type = $item->types[0];
                    $out[$type] = $name; 
                }
                
                $result['callback'] = 'success';
                $result['contextWrites']['to'] = json_encode($out);
            } else {
                $result['callback'] = 'error';
                $result['contextWrites']['to'] = $responseBody;
            }
            
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to'] = $responseBody;
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody();
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }
    
    

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

