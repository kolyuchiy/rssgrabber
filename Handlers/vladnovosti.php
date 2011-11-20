<?php
    /*
RSS Grabber / Выдиралка RSS
Converts any HTML page to RSS feed
Copyright (C) 2004  Kolia Morev <kolyuchiy@gmail.com>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
     */


require_once('rss.php');

class VladNovosti {
    var $url ='http://vladnovosti.ru/';
    var $insideItem = FALSE;
    var $insideTitle = FALSE;
    var $parsedTitle = FALSE;
    var $insideDescription = FALSE;
    var $parsedDescription = FALSE;
    var $parsedLink = FALSE;
    
    function MyHandler() {
    }
    
    function openHandler(& $parser,$name,$attrs) {
        if ($name == 'html') RSSWriter::beginRSS(
            'windows-1251', 
            'Владимирская служба новостей', 
            'http://vladnovosti.ru/', 
            'Новостная лента.', 
            'ru');
        
        if (!$this->insideItem
        and $name == 'div' 
        and $attrs['class'] == 'zag') {
            RSSWriter::beginItem();
            $this->insideItem = TRUE;
        }

        if ($this->insideItem
        and !$this->insideTitle
        and !$this->parsedTitle
        and $name == 'div'
        and $attrs['class'] == 'zag') {
            RSSWriter::beginTitle();
            $this->insideTitle = TRUE;
        }

        if ($this->insideItem
        and !$this->parsedLink
        and $name == 'a') {
            RSSWriter::beginLink();
            RSSWriter::putLink(htmlentities($attrs['href']));
            RSSWriter::endLink();
            $this->parsedLink = TRUE;
        }

        if ($this->insideItem
        and $this->parsedTitle
        and !$this->parsedDescription
        and $name == 'a') {
            RSSWriter::beginDescription();
            $this->insideDescription = TRUE;
        }

    }
    
    function closeHandler(& $parser,$name) {
        if ($name == 'html') RSSWriter::endRSS();

        if ($this->insideItem
        and $this->insideTitle
        and $name == 'div') {
            RSSWriter::endTitle();
            $this->insideTitle = FALSE;
            $this->parsedTitle = TRUE;
        }

        if ($this->insideItem
        and $this->insideDescription
        and $name == 'a') {
            RSSWriter::endDescription();
            $this->insideDescription = FALSE;
            $this->parsedDescription = TRUE;
        }

        if ($this->insideItem 
        and $this->parsedDescription) {
            RSSWriter::endItem();
            $this->insideItem = FALSE;
            $this->parsedTitle = FALSE;
            $this->parsedDescription = FALSE;
            $this->parsedLink = FALSE;
        }
    }
    
    function dataHandler(& $parser,$data) {
        if ($this->insideItem
        and $this->insideTitle) {
            RSSWriter::putTitle($data);
        }

        if ($this->insideItem
        and $this->insideDescription) {
            RSSWriter::putDescription($data);
        }
    }
}

?>
