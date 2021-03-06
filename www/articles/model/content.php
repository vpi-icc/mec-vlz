<style type="text/css">
#navbar {
	position: fixed;
	right: 30px;
	min-width: 150px;
	cursor: pointer;
}	
#navbar a:hover {
	text-decoration: none;
}
</style>
<div data-spy="affix" data-offset-top="60" data-offset-bottom="200" class="pull-right" id="navbar">
	<table class="table table-hover">
			<tr>
				<td class="active"><a href="#modelInUse"><strong>Назначение модели</strong></a></td>
			</tr>
			<tr>
				<td class="active"><a href="#composition"><strong>Состав лабораторно-учебного модуля</strong></a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#model"><strong>Модель ветряной турбины</strong></a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#multimeter">Мультиметр</a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#formula">Формулы для расчета мощности</a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#src">Исходные данные</a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#result">Результаты расчета</a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#prezi">Презентация проекта</a></td>
			</tr>
				<tr>
				<td class="active"><a href="#model"><strong>Гидроустановка</strong> </a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#formulaHydro">Формулы для расчета мощности</a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#hydroMultimeter">Мультиметр</a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#hydroSrc">Исходные данные</a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#hydroResult">Результаты расчета</a></td>
			</tr>
			<tr>
				<td class="active second-menu"><a href="#hydroPrezi">Презентация проекта</a></td>
			</tr>
	</table>
</div>
<h2><abbr title="Прообраз МЭК в миниатюре, на котором будут опробованы все планируемые к реализации технологии."><small>Модель МЭК:</small></abbr>
	<br><abbr title="Лабораторно-учебный модуль">ВИЭ1 </abbr> </h2>
<h3 id="modelInUse">Назначение модели:</h3>
<ol>
	<li>Проведения лабораторных работ по физике в    рамках школьной программы обучения. </li>
	<li>Популяризации использования возобновляемых источников электроэнергии. </li>
	<li>Развития инженерных способностей у школьников.</li>
	<li>Целевой ориентации ребят для поступления в учебные заведения на энергетические специальности. </li>
</ol>
<h3 id="composition">Лабораторно-учебный модуль состоит из:</h3>
<ol>
	<li><a href="#model">Действующей модели ветряной турбины, изготовленной школьниками.</a></li>
	<li><a href="#hydro">Действующей гидротурбины, изготовленной школьниками.</a></li>
	<li>Методических материалов для проведения наблюдений и исследований за проходящими физическими и электрическими процессами.</li>
	<li>Расчетного комплекса по определению отдельных физических и электрических характеристик энергетических установок. </li>
</ol>
<h3 id="model"><a href="#model"><strong>Модель ветряной турбины</strong></a></h3>
<blockquote>
		<img src="./img/img1.png" alt="" class="improve-img">
		<small>
			<ol>
				<li>Кейс - рабочая площадка	</li>
				<li>Источник подачи воздуха с регулятором вращения</li>
				<li>Ротор с лопастями различных 
     видов и типоразмеров</li>
     			<li>Мачта ротора с генератором</li>
     			<li>Регулируемое основание мачты</li>
     			<li>Вольтметр</li>
     			<li>Амперметр</li>
     			<li>Анемометр</li>
			</ol>
			<h6 class="text-right">*Позиции 7,8 не показаны</h6>
		</small>	
		Источник движения воздуха - <em>вентилятор</em>. <br>
		<h3 id="fanСharacteristics">Характеристики вентилятора:</h3>
		<table class="table table-hover">
			<tr>
		        <td>Тип</td>
		        <td>осевой</td>
		    </tr>
		    <tr>
		        <td>Диаметр, мм</td>
		        <td>100</td>
		    </tr>
		    <tr>
		        <td>Напряжение, В</td>
		        <td>220-240</td>
		    </tr>
		    <tr>
		        <td>Частота, Гц</td>
		        <td>50</td>
		    </tr>
		    <tr>
		        <td>Частота оборотов, мин -1</td>
		        <td>2300</td>
		    </tr>
		    <tr>
		        <td>Производительность, м3/ч</td>
		        <td>95</td>
		    </tr>
		    <tr>
		        <td>Уровень шума, дБ(А) 3м</td>
		        <td>33</td>
		    </tr>
		    <tr>
		        <td>Вес, кг</td>
		        <td>0,4</td>
		    </tr>
		</table>
		<blockquote>
			<img src="./img/diagram4.png">
			<small>Характеристики генератора постоянного тока</small>
		</blockquote>
		<pre>
			<table class="table table-hover">
			<tr>
	        	<td>Тип генератора</td>
	        	<td>Напряжение B</td>
	        	<td>Сила тока'ном' A</td>
	        	<td>МНОМ' Нм</td>
	        	<td>"ном- об/мин</td>
	        	<td>Сила тока A</td>
	        	<td>"х,х-</td>
	        	<td>КПД,%</td>
	        	<td>Масса, г</td>
	    	</tr>
	    	<tr>
	        	<td>ДИ-12А</td>
	        	<td>3</td>
	        	<td>0,45</td>
	        	<td>1</td>..>>
	        	<td>5000</td>
	        	<td>0,18</td>
	        	<td>6400</td>
	        	<td>35</td>
	        	<td>40</td>
	    	</tr>
		</table>
	</pre>
	<h4 id="generator">Размеры генератора</h4>
	<img src="./img/img3.png" class="improve-img"> <br>
	<img src="./img/imd4.png" class="improve-img">
	<small>Быстроходные двухлопастное и трехлопастные ветроколеса диаметром 120 мм были построены в соответствие с таблицей 5, делением размеров на 10.</small>
	<img src="./img/imd5.png" class="improve-img">
	<h4 id="fan">Законченная форма лопасти получена в соответствии с профилями сечений, построенных на основе таблицы 5.</h4>
	<img src="./img/img6.png" class="improve-img">

	<h4 id="multimeter">Мультиметр</h4>
	<img src="http://www.electrosarg.ru/Upload/dt-838%20copy.jpg" class="improve-img">
	<br>
	<table width="100%" cellspacing="0" cellpadding="3" class="table table-hover" > 
            <tbody> 
              <tr> 
                <td valign="center" style="text-align: center; " class="ltdparamtable"><strong>ПАРАМЕТРЫ</strong></td> 
                <td valign="top" style="text-align: center; " class="rtdparamtable"><strong>DT 838 ( 
DT838 )</strong></td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Постоянное 
напряжение (DCV)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">200мВ - 2В - 
20В - 200В - 1000В </td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Переменное 
напряжение (ACV)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">200В - 750В</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Постоянный 
ток (DCA)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">2мА - 20мА - 
200мА - 10А</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Сопротивление
 ( Ω)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">200Ом - 2КОм - 
20КОм - 200КОм 
- 2МОм</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Проверка 
диодов </strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">3В / 0.8мА</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Коэф. усил. 
транзисторов 
(hFE)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">1 ~ 1000</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Звуковой 
пробник</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">+</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Выходной 
генератор</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">-</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Температура 
(TEMP, °С)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">-20 °С ~ 1000 
°С</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left"><strong>Аксессуары</strong></td> 
                <td valign="center" align="middle" class="lastrtdparamtable">Щупы, 
термопара типа "К"</td> 
              </tr> 
            </tbody> 
          </table>
	</blockquote>

<h3 id="formula">Формулы для расчета мощности:</h3>
	<blockquote>
		<p class="text-primary">P = 0,5 * ρ * A * Cp * U&#179 * Ng * Nb</p> 
		<small>
			<br>
			P  = мощность в ваттах <br>
			ρ  = плотность воздуха (около 1,225 кг/м3 на уровне моря, менее выше) <br>
			А  = ометаемая площадь(м2) <br>
			Cp = Коэффициент мощности  <br>
			U  = скорость ветра в м / с  <br>
			Ng = КПД генератора (50% для автомобильного генератора, 80% или, возможно, больше для генератора с постоянным магнитом или подключенных к сети асинхронного генератора) <br>
			Nb = КПД коробки передач / подшипников (может быть 95%) <br>
		</small>	 
	</blockquote>
<h3 id="src">Исходные данные:</h3>
<pre>
	<table class="table table-hover">
		<tr>
	        <th><strong>Название константы</strong></th>
	        <th><strong>Буквенное обозначение</strong></th>
	        <th><strong>Размерность</strong></th>
	        <th><strong>Величина</strong></th>
	
	    </tr>
		<tr>
	        <td>Плотность воздуха</td>
	        <td>ρ</td>
	        <td>кг/м&#179</td>
	        <td>1,23</td>
	    </tr>
	    <tr>
	        <td>Длина лопасти</td>
	        <td>R</td>
	        <td>м</td>
	        <td>0,12</td>
	    </tr>
	    <tr>
	        <td>Ометаемая площадь </td>
	        <td>A</td>
	        <td>м&#178</td>
	        <td>0,05</td>
	    </tr>
	    <tr>
	        <td>Cкорость ветра</td>
	        <td>U</td>
	        <td>м/с</td>
	        <td>1,00</td>
	    </tr>
	    <tr>
	        <td>Коэф. преобразования кинетической E в электрическую</td>
	        <td></td>
	        <td></td>
	        <td>0,35</td>
	    </tr>
	    <tr>
	        <td>КПД генератора</td>
	        <td>Ng</td>
	        <td></td>
	        <td>0,80</td>
	    </tr>
	    <tr>
	        <td>КПД преобразователя скоростей</td>
	        <td>Nb</td>
	        <td></td>
	        <td>0,95</td>
	    </tr>
	    <tr>
	        <td><hr></td>
	        <td><hr></td>
	        <td><hr></td>
	        <td><hr></td>
	    </tr>
	    <tr>
	        <td>Итого мощность установки</td>
	        <td>P</td>
	        <td>Вт</td>
	        <td>0,01</td>
	    </tr>
	    <tr>
	        <td>Итого мощность установки</td>
	        <td>P</td>
	        <td>кВт</td>
	        <td>0,00</td>
	    </tr>
	</table>
</pre>
<h3 id="result">Результаты расчета:</h3> 
<img src="./img/diagram3.PNG" alt="" class="improve-img">  <br>
<h4>Зависимость энергии от силы ветра:</h4>
<img src="./img/diagram2.PNG" alt="" class="improve-img">
<h3 id="prezi">Презентация проекта:</h3>
<iframe width="640" height="480"  src="//www.youtube.com/embed/zknQOVdyYBA?rel=0" frameborder="0" allowfullscreen class="improve-img"></iframe>



<!-- -->

<h3 id="hydro"><a href="#hydro"><strong>Гидроустановка</strong></a></h3>
<blockquote>
	<img src="./img/img7.png" alt="" class="improve-img">
	<small>
		1 - корпус-емкость, <br>
2 - водяное колесо, <br>
3 - ось ротора, <br>
4 - маховое колесо, <br>
5 - генератор, <br>
6 - трубка для подачи воды, <br>
7 - наливной шланг, <br>
8 - сливной шланг, <br>
9 - вентиль.
	</small>

</blockquote>

<h3 id="formulaHydro">Формулы для расчета мощности:</h3>
	<blockquote>
		<p class="text-primary">P = Q * ρ * H * g  * η</p> 
		<small>
			<br>
			P  = мощность в ваттах <br>
			ρ  = Плотность воды <br>
			Q  = Расход воды <br>
			H  = Напор    <br>
			g = Ускорение свободного падения  <br>
			η =  KПД  <br>
		</small>	 
	</blockquote>
<h4 id="hydroMultimeter">Мультиметр</h4>
	<img src="http://www.electrosarg.ru/Upload/dt-838%20copy.jpg" class="improve-img">
	<br>
	<table width="100%" cellspacing="0" cellpadding="3" class="table table-hover" > 
            <tbody> 
              <tr> 
                <td valign="center" style="text-align: center; " class="ltdparamtable"><strong>ПАРАМЕТРЫ</strong></td> 
                <td valign="top" style="text-align: center; " class="rtdparamtable"><strong>DT 838 ( 
DT838 )</strong></td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Постоянное 
напряжение (DCV)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">200мВ - 2В - 
20В - 200В - 1000В </td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Переменное 
напряжение (ACV)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">200В - 750В</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Постоянный 
ток (DCA)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">2мА - 20мА - 
200мА - 10А</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Сопротивление
 ( Ω)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">200Ом - 2КОм - 
20КОм - 200КОм 
- 2МОм</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Проверка 
диодов </strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">3В / 0.8мА</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Коэф. усил. 
транзисторов 
(hFE)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">1 ~ 1000</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Звуковой 
пробник</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">+</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Выходной 
генератор</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">-</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left" class="ltdparamtable"><strong>Температура 
(TEMP, °С)</strong></td> 
                <td valign="center" align="middle" class="rtdparamtable">-20 °С ~ 1000 
°С</td> 
              </tr> 
              <tr> 
                <td valign="top" align="left"><strong>Аксессуары</strong></td> 
                <td valign="center" align="middle" class="lastrtdparamtable">Щупы, 
термопара типа "К"</td> 
              </tr> 
            </tbody> 
          </table>
	</blockquote>
<h3 id="hydroSrc">Исходные данные:</h3>
<pre>
	<img src="./img/img8.png" alt="" class="improve-img">
</pre>
<h3 id="hydroResult">Результаты расчета:</h3> 
<img src="./img/img9.png" alt="" class="improve-img">  <br>

<h3 id="hydroPrezi">Презентация проекта:</h3>
<iframe width="640" height="480"  src="//www.youtube.com/embed/VeKyUsKWEU8?rel=0" frameborder="0" allowfullscreen class="improve-img"></iframe>
