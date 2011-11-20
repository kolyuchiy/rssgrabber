<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>RSS Grabber / Выдиралка RSS</title>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<meta name="ROBOTS" content="ALL" />

<link rel="alternate" type="application/rss+xml" title="Де-Факто RSS" href="defakto.xml" />
<link rel="alternate" type="application/rss+xml" title="ТВ6 Владимир RSS" href="tv6.xml" />
<link rel="alternate" type="application/rss+xml" title="Комсомольская правда Владимир RSS" href="vladimirkp.xml" />
<link rel="alternate" type="application/rss+xml" title="Владимирская служба новостей RSS" href="vladnovosti.xml" />
<link rel="alternate" type="application/rss+xml" title="ГТРК Владимир RSS" href="vladtv.xml" />
<link rel="alternate" type="application/rss+xml" title="WEC.Ru RSS" href="wec.xml" />
<link rel="alternate" type="application/rss+xml" title="Призыв RSS" href="prizyv.xml" />
<link rel="alternate" type="application/rss+xml" title="Bash.Org.Ru RSS" href="bashorgru.xml" />
<link rel="alternate" type="application/rss+xml" title="Nag.Ru RSS" href="nagru.xml" />
<link rel="alternate" type="application/rss+xml" title="Диверсант - Daily RSS" href="diversantdaily.xml" />
<link rel="alternate" type="application/rss+xml" title="Тупичок Гоблина RSS" href="operru.xml" />

</head>

<body>

<h1>RSS Grabber / Выдиралка RSS</h1>

<p><img src="rss.png" alt="rss"/></p>

<ol>
<li><a href="defakto.xml">Де-Факто (КЭТИС)</a></li>
<li><a href="tv6.xml">ТВ6 Владимир</a></li>
<li><a href="vladimirkp.xml">Комсомольская правда Владимир</a></li>
<li><a href="vladnovosti.xml">Владимирская служба новостей</a></li>
<li><a href="vladtv.xml">ГТРК Владимир</a></li>
<li><a href="wec.xml">WEC.Ru</a></li>
<li><a href="prizyv.xml">Призыв</a></li>
</ol>

<ol>
<li><a href="bashorgru.xml">Bash.Org.Ru</a></li>
<li><a href="nagru.xml">NAG.Ru: Все об Ethernet провайдинге</a></li>
<li><a href="diversantdaily.xml">Диверсант - Daily</a></li>
<li><a href="operru.xml">Тупичок Гоблина</a></li>
</ol>

<p>Исходники по ссылке внизу страницы. Просьба если будете писать свои модули
для каких-либо сайтов, прислать этот модуль мне для выкладывания.</p>

<p>&copy; 2004, <a href="http://koliamorev.narod.ru/">Kolia Morev</a></p>

</body>
</html>

<?php
define("_BBCLONE_DIR", "../stats/");
define("COUNTER", _BBCLONE_DIR."mark_page.php");
if (is_readable(COUNTER)) include_once(COUNTER); 
?>

