<?php
    /*
RSS Grabber / ��������� RSS
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

class DeFakto {
    var $url = 'http://www.ketis.ru/defakto.php';
    var $insideItem = FALSE;
    var $insideTitle = FALSE;
    var $parsedTitle = FALSE;
    var $insideDescription = FALSE;
    var $parsedDescription = FALSE;
    var $parsedLink = FALSE;
    
    function openHandler(& $parser,$name,$attrs) {
        if ($name == 'html') RSSWriter::beginRSS('windows-1251', '��-����� (�����)', $this->url, '������������ �������.', 'ru');
        
        // <img alt="" src="defakto.php_files/addnews.gif"
        if (!$this->insideItem
        and $name == 'img' 
        and $attrs['src'] == 'http://www.ketis.ru/news/skins/images/addnews.gif') {
            RSSWriter::beginItem();
            $this->insideItem = TRUE;
        }

        if ($this->insideItem
        and !$this->insideTitle
        and $name == 'b') {
            RSSWriter::beginTitle();
            $this->insideTitle = TRUE;
        }

        // <font style="font-family: verdana,arial,sans-serif; color: rgb(102, 102, 102); font-size: 11px;">
        if ($this->insideItem
        and $this->parsedTitle
        and !$this->parsedDescription
        and $name == 'font'
        and $attr['style'] =~ "font-family: verdana, arial, sans-serif; color:#666; font-size: 11;") {
            RSSWriter::beginDescription();
            $this->insideDescription = TRUE;
            $this->parsedDescription = TRUE;
        }

        if ($this->insideItem
        and $this->parsedDescription
        and !$this->parsedLink
        and $name == 'a') {
            RSSWriter::beginLink();
            RSSWriter::putLink('http://www.ketis.ru' . $attrs['href']);
            RSSWriter::endLink();
            $this->parsedLink = TRUE;
        }
    }
    
    function closeHandler(& $parser,$name) {
        if ($name == 'html') RSSWriter::endRSS();

        // </tbody>
        if ($this->insideItem 
        and $name == 'table') {
            RSSWriter::endItem();
            $this->insideItem = FALSE;
            $this->parsedTitle = FALSE;
            $this->parsedDescription = FALSE;
            $this->parsedLink = FALSE;
        }

        if ($this->insideItem
        and $this->insideTitle
        and $name == 'b') {
            RSSWriter::endTitle();
            $this->insideTitle = FALSE;
            $this->parsedTitle = TRUE;
        }

        if ($this->insideItem
        and $this->insideDescription
        and $name == 'font') {
            RSSWriter::endDescription();
            $this->insideDescription = FALSE;
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
