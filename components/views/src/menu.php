<?php
/**
 * User: Vah
 * Date: 15.10.2015
 */
$this->title = $title;
?>

<ul class="nav nav-pills links-left">
    <?foreach($links as $link)
    if (isset($link['subMenu'])):?>
        <li class="active"><a href="/blog/<?=$link['url']?>"
               title="<?=$link['comment']?>"><?=$link['name']?></a>
        </li>
        <?foreach($link['subMenu'] as $subMenu)
            echo '<li class="submenu '
                . (($activeSubLink == $subMenu['url']) ? 'active' : '')
                . '"><a href="/blog/' . $link['url'] . '/' . $subMenu['url'] . '"'
                . 'title="' . $subMenu['comment'] . '">'
                . $subMenu['name']. '</a></li>';
    else:
        echo '<li '
            . (($activeLink == $link['url']) ? 'class="active"' : '')
            . '><a href="/blog/' . $link['url'] . '"'
            . 'title="' . $link['comment'] . '">'
            . $link['name']. '</a></li>';

    endif;?>
</ul>