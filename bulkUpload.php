<?php
    namespace CloudCMS\SDK;
    
    include __DIR__ . '/driver.php';

    try 
    {    
        $fileslist = array();
        $fileslist[] = array( 
            'name' => 'files',
            'filename' => 'author.json', 
            'contents' => fopen('./author.json', 'r'), 
            '_filePath' => '/Bulk-Uploads/author.json' 
        );
        $fileslist[] = array( 
            'name' => 'files',
            'filename' => 'jkr.jpg', 
            'contents' => fopen('./jkr.jpg', 'r'), 
            '_filePath' => '/Bulk-Uploads/jkr.jpg' 
        );

        $options = array(); 
        $options['multipart'] = $fileslist; 
        // $options['headers']['Content-Type'] = 'multipart/form-data'; 
        $options['headers']['Authorization'] = 'bearer ' . $accessToken;

        // for ($i = 0; $i < sizeof($options['multipart']); $i++)
        // {
        //     $file = $options['multipart'][$i];
            
        //     echo $i . "> " . $file['filename'] . "\n";
        // }

        $post_url = $baseURL . '/repositories/' . $repositoryId . '/branches/' . $branchId . '/nodes'; 

        echo "\n post_url: {$post_url}" . "\n\n";

        $request = $provider->getAuthenticatedRequest(
            'POST',
            $post_url,
            $accessToken,
            $options
        );

        foreach ($request->getHeaders() as $name => $values) {
            echo $name . ': ' . implode(', ', $values) . "\r\n";
        }

        echo "\n accessToken: {$accessToken} \n";
        echo "\n request" . "\n\n";

        $response = $provider->getResponse($request);

        echo "\n response" . "\n\n";

    } 
    catch (Exception $e) 
    {
        echo "Error: {$e->getMessage()} \n";        
        
        // Failed to get the access token
        exit();
    }
?>