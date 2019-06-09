<?php

namespace notes\Src;

class NotesHelper
{

    public function processContent($request)
    {
        $response = array();
        $dom = new \DOMDocument();
        $dom->loadHTML($request->content);

        $elements = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p'];
        $title = $this->getTitle($dom, $elements);
        $response['title'] = $title[1];
        $response['content'] = $request->content;
        $response['caption'] = $this->getContent($title[0], $dom, $request);
        
        return $response;
    }

    private function getTitle($dom,$elements)
    {
        foreach($elements as $element) {
            if ($dom->getElementsByTagName($element)->length) {
                if ($element == 'p') {
                    return [1, substr($dom->getElementsByTagName($element)[0]->nodeValue, 0, 25) . '..'];
                }
                return [0, substr($dom->getElementsByTagName($element)[0]->nodeValue, 0, 25) . '..'];
            }
        }

    }

    private function getContent($type, $dom, $request)
    {
        return substr(strip_tags($request->content), 0, 50) . '..';
    }

    private function encrypt()
    {

    }
    
    private function decrypt()
    {

    }
}
