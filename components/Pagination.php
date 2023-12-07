<?php

class Pagination {

    private $max = 5;
    private $index = 'page';
    private $current_page;
    private $total;
    private $limit;

    public function __construct($total, $currentPage, $limit, $index) {
        $this->total = $total;
        $this->limit = $limit;
        $this->index = $index;
        $this->amount = $this->amount();
        $this->setCurrentPage($currentPage);
    }

    public function get()  {

        $links = null;
        $limits = $this->limits();
        $html = '<ul class="pagination">';

        # Генерируем ссылки

        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # Если текущая это текущая страница, ссылки нет и добавляется класс active
            if ($page == $this->current_page) {
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
            } else {
                # Иначе генерируем ссылку
                $links .= $this->generateHtml($page);
            }

        }

        # Если ссылки создались

        if (!is_null($links)) {

            # Если текущая страница не первая

            if ($this->current_page > 1)

            # Создаём ссылку "На первую"

                $links = $this->generateHtml(1, '&lt;') . $links;



            # Если текущая страница не первая

            if ($this->current_page < $this->amount)

            # Создаём ссылку "На последнюю"

                $links .= $this->generateHtml($this->amount, '&gt;');

        }

        $html .= $links . '</ul>';

        return $html;

    }


    /**
     * Для генерации HTML-кода ссылки
     * @param integer $page - номер страницы
     * 
     * @return
     */

    private function generateHtml($page, $text = null) {

        # Если текст ссылки не указан, казываем, что текст - цифра страницы

        if (!$text) $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';

        //$currentURI = rtrim($_SERVER['REQUEST_URI'], '/');

        //$currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);

        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);

        # Формируем HTML код ссылки и возвращаем

        $tt= '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li><br>';

        //echo "tt=$tt   ;;";

        //echo $tt;

        //echo "currentURI=$currentURI    text=$text  page=$page;;";

        return

                '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';

    }


    /**
     *  Для получения, откуда стартовать
     * 
     * @return массив с началом и концом отсчёта
     */

    private function limits() {

        # Вычисляем ссылки слева (чтобы активная ссылка была посередине)

        $left = $this->current_page - round($this->max / 2);

        # Вычисляем начало отсчёта

        $start = $left > 0 ? $left : 1;

        # Если впереди есть как минимум $this->max страниц

        if ($start + $this->max <= $this->amount)

        # Назначаем конец цикла вперёд на $this->max страниц или просто на минимум

            $end = $start > 1 ? $start + $this->max : $this->max;

        else {
            # Конец - общее количество страниц
            $end = $this->amount;

            # Начало - минус $this->max от конца
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        return  array($start, $end);
    }


    /**
     * Для установки текущей страницы
     * 
     * @return
     */

    private function setCurrentPage($currentPage) {

        # Получаем номер страницы

        $this->current_page = $currentPage;

        # Если текущая страница боле нуля

        if ($this->current_page > 0) {

            # Если текунщая страница меньше общего количества страниц

            if ($this->current_page > $this->amount)

            # Устанавливаем страницу на последнюю

                $this->current_page = $this->amount;

        } else

        # Устанавливаем страницу на первую

            $this->current_page = 1;

    }

    /**
     * Для получеия общего числа страниц
     * 
     * @return число страниц
     */

    private function amount() {

        # Делим и возвращаем

        //echo "tot=".$this->total."limit=".$this->limit;

        return round(($this->total / $this->limit)+0.5);
    }

}