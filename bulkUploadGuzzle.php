<?php    
    include __DIR__ . '/driver.php';

    try 
    {    
        $client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:8080']);
        $headers = [
            'Authorization' => 'bearer ' .$accessToken
        ];

        // // GuzzlePhp docs: http://docs.guzzlephp.org/en/stable/request-options.html?highlight=form-data#multipart
        // simple test...
        // $response = $client->request('GET', 'repositories', [
        //     'headers' => $headers
        // ]);

        // $body = $response->getBody();
        // echo $body;

        $fileslist = array();
        $fileslist[] = array( 
            'name' => 'files_files',
            'filename' => 'author.json', 
            'contents' => fopen('./author.json', 'r'), 
            'headers' => [
                'parentFolderPath' => '/Bulk-Uploads/author.json' 
            ]
        );
        $fileslist[] = array( 
            'name' => 'files_files',
            'filename' => 'jkr.jpg', 
            'contents' => fopen('./jkr.jpg', 'r'), 
            'headers' => [
                'parentFolderPath' => '/Bulk-Uploads/jkr.jpg' 
            ]
        );

        $post_url = 'repositories/' . $repositoryId . '/branches/' . $branchId . '/nodes'; 

        $response = $client->request('POST', $post_url, [
            'headers' => $headers,
            'multipart' => $fileslist
        ]);
    } 
    catch (Exception $e) 
    {
        echo "Error: {$e->getMessage()} \n";        
        
        exit();
    }
?>