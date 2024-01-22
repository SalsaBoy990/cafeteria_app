<template>
    <div class="container relative">

        <Alert v-if="message !== undefined" :color="'info'" :heading="''">
            {{ message }}
        </Alert>

        <h1 class="margin-top-0">Clean.ui</h1>

        <h2 class="h3 text-gray-60 semibold">COMPONENTS</h2>

        <h3>1. Accordion</h3>
        <p>Just because you have the emotional range of a teaspoon doesn’t mean we all have.</p>


        <h3>2. Alert</h3>
        <p>The <a href="#">alert</a>
            class can also be used for all kinds of alerts:</p>

        <!-- Alert components -->
        <Alert :color="'danger'" :heading="'Danger!'">
            <p class="margin-0">Red often indicates a dangerous or negative situation.</p>
        </Alert>

        <Alert :color="'warning'" :heading="'Warning!'" :show-close-button="true">
            <p class="margin-0">Yellow often indicates a warning that might need attention.</p>
        </Alert>

        <Alert :color="'success'" :heading="'Success!'" :show-close-button="true">
            <p class="margin-0">Green often indicates something successful or positive.</p>
        </Alert>

        <Alert :color="'info'" :heading="'Info!'" :show-close-button="true">
            <p class="margin-0">Blue often indicates a neutral informative change or action.</p>
        </Alert>


        <hr>


        <h3>3. Badge</h3>
        <p>The <a href="#">badge</a>
            classes are capable of displaying all kinds of tags, labels, badges and signs:</p>
        <p><span class="badge fs-14 circle gray-60 text-white">2</span>
            <span class="badge fs-14 circle primary text-white">8</span>
            <span class="badge fs-14 circle red text-white">A</span>
            <span class="badge fs-14 circle accent">B</span>
        </p>

        <p><span class="badge fs-14 gray-60">New</span>
            <span class="badge fs-14 accent">Warning</span>
            <span class="badge fs-14 red">Danger</span>
            <span class="badge fs-14 blue">Info</span>
        </p>

        <div class="row-padding">
            <div class="half margin-bottom-1">
                <div class="badge round green margin-bottom-1">
                    <div class="badge round green">Falcon Ridge Parkway</div>
                </div>
                <div>
                    <div class="badge fs-64 red">S</div>
                    <div class="badge fs-64 black">A</div>
                    <div class="badge fs-64 orange">L</div>
                    <div class="badge fs-64 blue">E</div>
                </div>
            </div>

            <div class="half">
                <div class="badge fs-24 padding-large round-large red center">DO NOT<br>
                    BREATHE<br>UNDER WATER
                </div>
            </div>
        </div>


        <hr>


        <h3>4. Bar (navbar)</h3>
        <p>The <b>bar</b> class can be used to create a horizontal bar:
        </p>

        <div class="bar">
            <a href="javascript:void(0)" class="bar-item">Home</a>
            <a href="javascript:void(0)" class="bar-item">Link 1</a>
            <a href="javascript:void(0)" class="bar-item">Link 2</a>
            <a href="javascript:void(0)" class="bar-item hide-mobile">Link 3</a>
            <a href="javascript:void(0)" class="bar-item float-right">
                <font-awesome-icon :icon="['fas', 'search']"/>
            </a>
        </div>

        <p>Navigation bar with input:</p>
        <div class="navbar border">
            <nav class="flex flex-row">
                <a href="javascript:void(0)" class="bar-item gray-20 mobile">Home</a>
                <a href="javascript:void(0)" class="bar-item mobile">Link 1</a>
                <a href="javascript:void(0)" class="bar-item mobile">Link 2</a>
            </nav>
            <div class="bar-item mobile bar-search">
                <input type="text" class="white" placeholder="Search...">
                <a href="javascript:void(0)" class="button primary">
                    <font-awesome-icon :icon="['fas', 'search']"/>
                </a>
            </div>
        </div>

        <p>Navigation bar with dropdown:</p>
        <div class="bar flex">
            <a href="javascript:void(0)" class="bar-item mobile">Home</a>
            <a href="javascript:void(0)" class="bar-item mobile">Link 1</a>

            <Dropdown :dropdown="'click'">
                <template #links>
                    <a class="bar-item" href="javascript:void(0)">Link 1</a>
                    <a class="bar-item" href="javascript:void(0)">Link 2</a>
                    <a class="bar-item" href="javascript:void(0)">Link 3</a>
                </template>
            </Dropdown>

            <a href="javascript:void(0)" class="bar-item float-right mobile"><i
                class="fa fa-search"></i></a>
        </div>
        <div class="hide-mobile">
            <p>Customized bars:</p>

            <div class="bar">
                <a class="bar-item mobile green no-underline third" href="javascript:void(0)">Home</a>
                <a class="bar-item mobile third" href="javascript:void(0)">Link 1</a>
                <a class="bar-item mobile third" href="javascript:void(0)">Link 2</a>
            </div>

        </div>


        <hr>


        <h3>5. Box</h3>
        <p>The <a href="#">box</a> class is the most important of the
            Clean.CSS classes. It provides equality like:</p>
        <ul>
            <li>Common margins</li>
            <li>Common paddings</li>
            <li>Common vertical alignments</li>
            <li>Common horizontal alignments</li>
            <li>Common fonts</li>
            <li>Common colors</li>
        </ul>

        <p>The box class is typically used with HTML container elements, like:</p>
        <p>&lt;div&gt;, &lt;header&gt;, &lt;footer&gt;, &lt;article&gt;, &lt;section&gt;, &lt;blockquote&gt;, &lt;form&gt;,
            and
            more.</p>

        <article class="section">
            <div class="box gray-60 round-top">
                <h4 class="text-white">This is a Header</h4>
            </div>
            <div class="box gray-20 text-gray-80">
                <p>
                    This article is light grey and the text is brown.
                    This article is light grey and the text is brown.
                    This article is light grey and the text is brown.
                    This article is light grey and the text is brown.
                    This article is light grey and the text is brown.
                </p>
            </div>
            <div class="box gray-60 round-bottom">
                <p class="opacity">This is a footer.</p>
            </div>
        </article>

        <p>The <a href="#">box</a>
            class can also display all kinds of notes and quotes:</p>

        <div class="box round border border-default margin-bottom-top-1">
            <p>London is the most populous city in the United Kingdom,
                with a metropolitan area of over 9 million inhabitants.</p>
        </div>

        <div class="box round gray-20 border border-default margin-bottom-top-1">
            <p>London is the most populous city in the United Kingdom,
                with a metropolitan area of over 9 million inhabitants.</p>
        </div>

        <div class="box round red-pale leftbar border border-red margin-bottom-top-1">
            <p>London is the most populous city in the United Kingdom,
                with a metropolitan area of over 9 million inhabitants.</p>
        </div>

        <div class="box round green-pale bottombar border-green border margin-top-bottom-1">
            <p>London is the most populous city in the United Kingdom,
                with a metropolitan area of over 9 million inhabitants.</p>
        </div>

        <div class="box round leftbar border border-default orange-pale margin-top-bottom-1">
            <p><i class="fs-24 serif">"Make it as simple as possible, but not simpler."</i></p>
            <p>Albert Einstein</p>
        </div>


        <hr>


        <h3>6. Breadcrumb</h3>

        <p>Left-aligned breadcrumb</p>

        <nav class="breadcrumb">
            <ol>
                <li>
                    <a href="#">
                        <font-awesome-icon :icon="['fas', 'home']"/>
                        Home
                    </a>
                </li>
                <li>
                    <font-awesome-icon :icon="['fas', 'angle-right']"/>
                </li>
                <li>About page</li>
            </ol>
        </nav>

        <p class="text-center">Center-aligned breadcrumb</p>

        <nav class="breadcrumb breadcrumb-center">
            <ol>
                <li>
                    <a href="#">
                        <font-awesome-icon :icon="['fas', 'home']"/>
                        Home
                    </a>
                </li>
                <li>
                    <font-awesome-icon :icon="['fas', 'angle-right']"/>
                </li>
                <li>About page</li>
            </ol>
        </nav>


        <hr>


        <h3>7. Button</h3>
        <p>Disputationi dicam vulputate fusce detracto suavitate. Fabulas nisi mnesarchum meliore saperet. Audire et
            mattis option usu morbi.</p>
        <div class="section">
            <button class="primary">Primary</button>
            <button class="secondary">Secondary</button>
            <button class="danger">Danger</button>
            <button class="warning">Danger</button>
            <button class="info">Information</button>
            <button class="success">Success</button>
            <button class="black-button">Button</button>
            <button class="white-button">Button</button>
            <button disabled>Disabled</button>
            <button class="link">Button</button>
        </div>
        <div class="section">
            <button class="alt primary">Cancel</button>
            <button class="alt secondary">Cancel</button>
            <button class="danger alt round-large">Button</button>
            <button class="warning alt round-large">Button</button>
            <button class="info alt round">Button</button>
            <button class="success alt round-xlarge">Button</button>
            <button class="black padding-large hover-red border-black hover-border-red">Button</button>
        </div>

        <p>Circular or square buttons:</p>

        <div class="button-group">
            <button class="button-circle ripple danger">
                <font-awesome-icon :icon="['fas', 'trash']"/>
            </button>

            <button class="button-square ripple info">
                <font-awesome-icon :icon="['fas', 'plus']"/>
            </button>

            <button class="button-circle ripple success">
                <font-awesome-icon :icon="['fas', 'plus']"/>
            </button>

            <button class="button-circle ripple white-button">
                <font-awesome-icon :icon="['fas', 'minus']"/>
            </button>

            <button class="button-circle ripple black-button">
                <font-awesome-icon :icon="['fas', 'pencil']"/>
            </button>
        </div>

        <p>Button bar</p>

        <div class="bar three">
            <button class="bar-item white-button">
                <font-awesome-icon :icon="['fas', 'plus']"/>
            </button>
            <button class="bar-item white-button">Two</button>
            <button class="bar-item white-button">Three</button>
        </div>


        <hr>


        <h3>8. Card</h3>
        <p>The <a href="#">card</a>
            classes are suitable for both images and notes:</p>

        <div class="card card-4 content-600">
            <div class="box round-top primary">
                <h2 class="text-white">A Car</h2>
            </div>
            <div class="box round-bottom">
                <p>
                    A car is a wheeled, self-powered motor vehicle used for transportation.
                    Most definitions of the term specify that cars are designed to run primarily on roads,
                    to have seating for one to eight people, and to typically have four wheels.
                    <br><br>(Wikipedia)
                </p>
                <img :src="snowTops" alt="Car">
                <p>French Alps</p>
            </div>
        </div>

        <br>

        <div class="row-padding">
            <div class="half">
                <div class="card">
                    <div class="box primary round-top">
                        <h3 class="text-white">Movies 2014</h3>
                    </div>
                    <div class="box">
                        <ul>
                            <li>
                                <h4>Frozen</h4>
                                <p>The response to the animations was ridiculous</p>
                            </li>
                            <li>
                                <h4>The Fault in Our Stars</h4>
                                <p>Touching, gripping and genuinely well made</p>
                            </li>
                            <li>
                                <h4>The Avengers</h4>
                                <p>A huge success for Marvel and Disney</p>
                            </li>
                        </ul>
                    </div>

                    <div class="box text-white primary fs-24 round-bottom">&laquo;<span
                        class="text-white float-right">&raquo;</span></div>
                </div>
            </div>

            <div class="half">
                <div class="card">
                    <div class="box accent-dark round-top">
                        <h3 class="text-black">Movies 2014</h3>
                    </div>
                    <div class="box">
                        <ul>
                            <li>
                                <h4>Frozen</h4>
                                <p>The response to the animations was ridiculous</p>
                            </li>
                            <li>
                                <h4>The Fault in Our Stars</h4>
                                <p>Touching, gripping and genuinely well made</p>
                            </li>
                            <li>
                                <h4>The Avengers</h4>
                                <p>A huge success for Marvel and Disney</p>
                            </li>
                        </ul>
                    </div>
                    <div class="box accent-dark fs-24 round-bottom pointer">&laquo;<span
                        class="float-right">&raquo;</span></div>
                </div>
            </div>
        </div>


        <hr>


        <h3>9. Dropdown</h3>
        <p>The <a href="#"><strong>dropdown</strong></a>
            classes provide dropdowns:</p>
        <div class="row">
            <div class="col s6">
                <Dropdown :dropdown="'mouseover'">
                    <template #links>
                        <a class="bar-item" href="javascript:void(0)">Link 1</a>
                        <a class="bar-item" href="javascript:void(0)">Link 2</a>
                        <a class="bar-item" href="javascript:void(0)">Link 3</a>
                    </template>
                </Dropdown>
            </div>
            <div class="col s6">
                <!-- Dropdown component -->
                <Dropdown :dropdown="'click'">
                    <template #links>
                        <a class="bar-item" href="javascript:void(0)">Link 1</a>
                        <a class="bar-item" href="javascript:void(0)">Link 2</a>
                        <a class="bar-item" href="javascript:void(0)">Link 3</a>
                    </template>
                </Dropdown>
            </div>
        </div>


        <hr>


        <h3>10. Filter</h3>
        <p>Use <a href="#">Clean.CSS Filters</a> to search for a specific element inside a list, table, dropdown,
            etc:</p>


        <hr>


        <h3>11. Form</h3>
        <p>Happiness can be found even in the darkest of times if only one remembers to turn on the light.</p>

        <div class="row-padding">
            <div class="third">
                <label>One</label>
                <input type="text" placeholder="One">
            </div>
            <div class="third">
                <label>Two</label>
                <input type="text" placeholder="Two">
            </div>
            <div class="third">
                <label>Three</label>
                <input type="text" placeholder="Three">
            </div>
        </div>

        <div class="row-padding">
            <div class="half">
                <label>First name</label>
                <input type="text" placeholder="First name">
            </div>
            <div class="half">
                <label>Family name</label>
                <input type="text" placeholder="Family name">
            </div>
        </div>


        <div class="row-padding">
            <div class="half">
                <div class="margin-bottom-1">
                    <label for="fruit">Fruits<span class="text-red">*</span></label>
                    <select id="fruit" name="fruit">
                        <option value="Banana">Banana</option>
                        <option value="Apple">Apple</option>
                    </select>
                </div>

                <div class="margin-bottom-1">
                    <label for="logo">Select logo<span class="text-red">*</span></label>
                    <input type="file" class="form-control-file" id="logo"
                           name="logo">
                </div>

                <div class="margin-bottom-1">
                    <label for="gallery">Upload images for the gallery</label>
                    <input type="file" class="form-control-file" id="gallery"
                           name="gallery[]" multiple>
                </div>

            </div>
        </div>


        <div class="row-padding">
            <div class="half">
                <div class="card card-4 margin-top-1-5">
                    <div class="box primary round-top">
                        <h3 class="text-white">Input Form</h3>
                    </div>
                    <form class="box padding-bottom-1-5">
                        <label>Name</label>
                        <input type="text" disabled>

                        <label>Email</label>
                        <input type="email" required>

                        <label>Subject</label>
                        <textarea rows="5" name="message"></textarea>

                        <label>What do you need from the grocery's?</label>

                        <label for="milk" class="margin-top-bottom-0">
                            <input id="milk" type="checkbox" checked="checked">Milk
                        </label>

                        <label for="sugar" class="margin-top-bottom-0">
                            <input id="sugar" type="checkbox">Sugar
                        </label>

                        <label for="lemon" class="margin-top-bottom-0">
                            <input id="lemon" type="checkbox" disabled>Lemon (Disabled)
                        </label>

                    </form>
                </div>
            </div>

            <div class="half">
                <div class="card card-4 margin-top-1-5">
                    <div class="box red round-top">
                        <h3 class="text-white">Input Form</h3>
                    </div>
                    <form class="box padding-bottom-1-5">
                        <label>Name</label>
                        <input type="text" required>

                        <label>Email </label>
                        <input type="email" required>

                        <label>Subject </label>
                        <textarea name="message" rows="5"></textarea>

                        <label>Sex</label>

                        <label for="male" class="margin-top-bottom-0">
                            <input id="male" type="radio" name="gender" value="male" checked>Male
                        </label>
                        <label for="female" class="margin-top-bottom-0">
                            <input id="female" type="radio" name="gender" value="female" checked>Female
                        </label>
                        <label for="dont-know" class="margin-top-bottom-0">
                            <input id="dont-know" type="radio" name="gender" value="" disabled>Don't know (Disabled)
                        </label>

                    </form>
                </div>
            </div>
        </div>


        <hr>


        <h3>12. Heading</h3>

        <h1> Heading 1 </h1>
        <h2> Heading 2 </h2>
        <h3> Heading 3 </h3>
        <h4> Heading 4 </h4>
        <h5> Heading 5 </h5>
        <h6> Heading 6 </h6>


        <hr>


        <h3>13. Image</h3>
        <p>Styling <a href="#">images</a> in Clean.CSS is easy:</p>

        <div class="row-padding">
            <div class="col m3 s4">
                <img :src="imageLights" class="round"
                     alt="Northern Lights">
            </div>
            <div class="col m3 s4">
                <img :src="imageForest" class="circle" alt="Forest">
            </div>
            <div class="col m3 s4">
                <img :src="imageMountains" class="hover-opacity border"
                     alt="Mountains">
            </div>
            <div class="col m3 hide-mobile">
                <div class="relative">
                    <img :src="imageNature" alt="Nature"
                         class="card card-4">
                    <div class="bottomleft text-white black-transparent box padding-0-5">Nature
                    </div>
                </div>
            </div>

        </div>
        <div style="clear:both;margin-bottom:28px;"></div>


        <hr>

        <h3>14. Lightbox</h3>
        <p>Combine <a href="#">Modals</a> and <a href="#">Slideshows</a> to create a
            lightbox
            (modal image gallery):</p>


        <hr>


        <h3>15. List</h3>

        <h4> Ordered </h4>
        <ol>
            <li> First</li>
            <li> Second</li>
            <li> Third</li>
        </ol>

        <h4> Unordered </h4>
        <ul>
            <li> Item C</li>
            <li> Item A</li>
            <li> Item B</li>
        </ul>

        <h4> Nested </h4>
        <ol>
            <li>
                First
                <ul>
                    <li> Item A</li>
                    <li> Item B</li>
                </ul>
            </li>
            <li> Second</li>
            <li> Third</li>
        </ol>

        <h4> Definition Lists </h4>
        <dl>
            <dt> Term</dt>
            <dd> Definition 1</dd>
            <dd> Definition 2</dd>
            <dd> Definition 3</dd>
        </dl>


        <hr>


        <h3>16. Modal</h3>
        <p>The <a href="#">modal</a>
            class provides modal dialog in pure HTML:</p>

        <Modal>
            <template v-slot:header>
                <div>Header</div>
            </template>
            <template v-slot:body>
                <p>Some text. Some text. Some text.</p>
                <p>Some text. Some text. Some text.</p>
            </template>
            <template v-slot:footer>
                <p>Footer</p>
            </template>
        </Modal>


        <p>Modal Image:</p>


        <hr>


        <h3>17. Pagination</h3>
        <p>Clean.CSS provides simple ways for <a href="#">page pagination</a>.</p>

        <div class="bar pagination margin-top-bottom-1">
            <a class="bar-item button transparent" href="javascript:void(0)">&laquo;</a>
            <a class="bar-item button active" href="javascript:void(0)">1</a>
            <a class="bar-item button transparent" href="javascript:void(0)">2</a>
            <a class="bar-item button transparent" href="javascript:void(0)">3</a>
            <a class="bar-item button transparent" href="javascript:void(0)">4</a>
            <a class="bar-item button transparent" href="javascript:void(0)">5</a>
            <a class="bar-item button transparent" href="javascript:void(0)">&raquo;</a>
        </div>

        <div class="bar border round margin-top-bottom-1">
            <a href="javascript:void(0)" class="button link-button">
                <font-awesome-icon :icon="['fas', 'angle-double-left']"/>
                Previous</a>
            <a href="javascript:void(0)" class="button float-right link-button">Next
                <font-awesome-icon :icon="['fas', 'angle-double-right']"/>
            </a>
        </div>


        <hr>


        <h3>18. Person</h3>
        <p>We’ve all got both light and dark inside us. What matters is the part we choose to act on. That’s who we
            really are.</p>

        <div class="card relative padding-1 hover-gray-20 ">
            <img :src="avatar2"
                 class="float-left circle margin-right-1 profile" alt="Mike">
            <strong class="fs-24">Mike</strong><br>
            <i>Web Designer</i>

            <p>It does not do to dwell on dreams and forget to live.</p>

            <button onclick="this.parentElement.style.display='none'"
                    class="close-button white fs-18 absolute topright margin-right-0-5">
                <i class="fa fa-times"></i>
            </button>
        </div>


        <ul class="card card-4">

            <li class="hover-gray-20 relative">
                <img :src="avatar2"
                     class="float-left circle margin-right-1 profile" alt="Mike">
                <strong class="fs-24">Mike</strong><br>
                <i>Web Designer</i>
            </li>

            <li class="hover-gray-20 relative">
                <img :src="avatar5"
                     class="float-left circle margin-right-1 profile" alt="Jill">
                <strong class="fs-24">Jill</strong><br>
                <i>Support</i>
            </li>

            <li class="hover-gray-20 relative">
                <img :src="avatar6"
                     class="float-left circle margin-right-1 profile" alt="Jane">
                <strong class="fs-24">Jane</strong><br>
                <i>Accountant</i>
            </li>

            <li class="hover-gray-20 relative">
                <img :src="avatar5"
                     class="float-left circle margin-right-1 profile" alt="Jack">
                <strong class="fs-24">Jack</strong><br>
                <i>Advisor</i>
            </li>
        </ul>


        <hr>


        <h3>19. Progress Bar</h3>
        <p>Utamur liber parturient eget elaboraret ridiculus nullam facilisis. Enim errem pericula consectetur
            evertitur erat wisi praesent.</p>

        <div class="gray-20">
            <div class="box green center" style="width:25%">25%</div>
        </div>
        <br>

        <div class="gray-20">
            <div class="box red center" style="width:50%">50%</div>
        </div>
        <br>


        <hr>


        <h3>20. Slideshow</h3>
        <p>Clean.CSS provide <a href="#">slideshows</a> for cycling through images or
            other
            content:</p>


        <hr>


        <h3>21. Tab</h3>
        <p><a href="#">Tabs</a> are perfect for single page web applications, or for
            web
            pages capable of displaying different subjects.</p>


        <br>

        <p>Tabbed Image Gallery (Click on one of the pictures):</p>


        <hr>


        <h3>22. Table</h3>
        <p>No need to add any class. Aeque tempus vulputate voluptatibus iusto nobis. Consequat mediocrem mollis
            ornatus conubia class.</p>

        <table>
            <thead>
            <tr>
                <th> ID</th>
                <th> Column A</th>
                <th> Column B</th>
                <th> Column C</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> 0</td>
                <td> Apple</td>
                <td> Pear</td>
                <td> Mango</td>
            </tr>
            <tr>
                <td> 1</td>
                <td> Banana</td>
                <td> Kiwi</td>
                <td> Grape</td>
            </tr>
            <tr>
                <td> 2</td>
                <td> Orange</td>
                <td> Lemon</td>
                <td> Lime</td>
            </tr>
            </tbody>
        </table>


        <hr>


        <h3>23. Tooltip</h3>
        <p>The <strong>tooltip</strong>
            class can display all kinds of tooltips:</p>


        <p class="tooltip">
            Hover over this text!
            <font-awesome-icon :icon="['fas', 'question-circle']" :class="'pointer'"/>
            <span class="tooltip-content tooltip-top">Tooltip content</span>
        </p>

        <p class="tooltip">
            Hover over this text!
            <font-awesome-icon :icon="['fas', 'question-circle']" :class="'pointer'"/>
            <span class="tooltip-content tooltip-right">Tooltip content</span>
        </p>

        <p class="tooltip">
            Hover over this text!
            <font-awesome-icon :icon="['fas', 'question-circle']" :class="'pointer'"/>
            <span class="tooltip-content tooltip-bottom">Tooltip content</span>
        </p>

        <div class="clearfix">
            <p class="tooltip" style="float: right">
                <font-awesome-icon :icon="['fas', 'question-circle']" :class="'pointer'"/>
                Hover over this text!
                <span class="tooltip-content tooltip-left">Tooltip content</span>
            </p>
        </div>


        <hr>


        <h3>22. Video</h3>
        <video controls title="Test Video">
            <source :src="demoVideo" type="video/mp4">
            Your browser does not support the video tag.
        </video>


        <hr>


        <h2>UTILITIES</h2>


        <h3>1. Animation</h3>
        <p>The <a href="#">animate</a>
            classes provide an easy way to slide and fade in elements:</p>


        <hr>


        <h3>2. Color</h3>
        <p>Quam mandamus ocurreret sonet urna nihil explicari. Laudem fames intellegebat natoque repudiandae
            consectetur.</p>
        <div class="row">
            <div class="quarter">
                <div class="box primary center padding-1"><p>&nbsp;</p></div>
                <div class="box accent center padding-1"><p>&nbsp;</p></div>
            </div>
            <div class="quarter">
                <div class="box primary-dark center padding-1"><p>&nbsp;</p></div>
                <div class="box accent-dark center padding-1"><p>&nbsp;</p></div>
            </div>
            <div class="quarter hide-mobile">
                <div class="box orange text-white center padding-1"><p>&nbsp;</p></div>
                <div class="box red text-white center padding-1"><p>&nbsp;</p></div>
            </div>
            <div class="quarter hide-mobile">
                <div class="box green center padding-1"><p>&nbsp;</p></div>
                <div class="box green-dark center padding-1"><p>&nbsp;</p></div>
            </div>
        </div>


        <hr>


        <h3>4. Effect</h3>
        <p>Add special <strong>effects</strong> to any element:</p>
        <div class="row-padding center">

            <div class="col m3 hide-mobile">
                <img :src="imageWorkshop" alt="Workshop">
                <div class="red box">
                    <p>Normal</p>
                </div>
            </div>

            <div class="col m3 s4 opacity">
                <img :src="imageWorkshop" alt="Workshop">
                <div class="red box">
                    <p>Opacity</p>
                </div>
            </div>

            <div class="col m3 s4 grayscale">
                <img :src="imageWorkshop" alt="Workshop">
                <div class="red box">
                    <p>Grayscale</p>
                </div>
            </div>

            <div class="col m3 s4 sepia">
                <img :src="imageWorkshop" alt="Workshop">
                <div class="red box">
                    <p>Sepia</p>
                </div>
            </div>

        </div>


        <hr>


        <h3>5. Responsive Grid</h3>
        <p>The <a href="#">Responsive Grid</a>
            classes provide responsiveness for all device types: PC, laptop, tablet, and mobile.</p>

        <!-- First row -->
        <div class="row-padding">

            <div class="col m4">
                <div class="col s6 green center">
                    <p>1/2</p>
                </div>
                <div class="col s6 black center text-gray-20">
                    <p>1/2</p>
                </div>
            </div>

            <div class="col m4">
                <div class="col s4 green center">
                    <p>1/3</p>
                </div>
                <div class="col s4 black center text-gray-20">
                    <p>1/3</p>
                </div>
                <div class="col s4 black center text-gray-20">
                    <p>1/3</p>
                </div>
            </div>

            <div class="col m4">
                <div class="col s4 black center">
                    <p>1/3</p>
                </div>
                <div class="col s8 green center text-gray-20">
                    <p>2/3</p>
                </div>
            </div>

        </div>

        <!-- Second row -->
        <div class="row-padding">

            <div class="col m4">
                <div class="col s3 green center">
                    <p>1/4</p>
                </div>
                <div class="col s3 black center text-gray-20">
                    <p>1/4</p>
                </div>
                <div class="col s3 black center text-gray-20">
                    <p>1/4</p>
                </div>
                <div class="col s3 black center text-gray-20">
                    <p>1/4</p>
                </div>
            </div>

            <div class="col m4">
                <div class="col s6 green center">
                    <p>1/2</p>
                </div>
                <div class="col s3 black center">
                    <p>1/4</p>
                </div>
                <div class="col s3 black center text-gray-20">
                    <p>1/4</p>
                </div>
            </div>

            <div class="col m4">
                <div class="col s8 green center">
                    <p>2/3</p>
                </div>
                <div class="col s4 black center text-gray-20">
                    <p>1/3</p>
                </div>
            </div>

        </div>

        <!-- Third row -->
        <div class="row-padding">

            <div class="col m4">
                <div class="col s12 green center text-gray-20">
                    <p>1/1</p>
                </div>
            </div>

            <div class="col m4">
                <div class="col s3 black center">
                    <p>1/4</p>
                </div>
                <div class="col s3 black center">
                    <p>1/4</p>
                </div>
                <div class="col s6 green center">
                    <p>1/2</p>
                </div>
            </div>

            <div class="col m4">
                <div class="col s3 black center">
                    <p>1/4</p>
                </div>
                <div class="col s6 green center">
                    <p>1/2</p>
                </div>
                <div class="col s3 black center">
                    <p>1/4</p>
                </div>
            </div>

        </div>

        <!-- Fourth row -->
        <div class="row-padding">

            <div class="col m4">
                <div class="col center black text-gray-20" style="width:50px">
                    <p>50px</p>
                </div>
                <div class="rest green center text-gray-20">
                    <p>rest</p>
                </div>
            </div>

            <div class="col m4">
                <div class="col s3 black center">
                    <p>1/4</p>
                </div>
                <div class="rest green center text-gray-20">
                    <p>rest</p>
                </div>
            </div>

            <div class="col m4">
                <div class="col center black text-gray-20 float-left" style="width:100px">
                    <p>100px</p>
                </div>
                <div class="col center black text-gray-20 float-right" style="width:45px">
                    <p>45px</p>
                </div>
                <div class="rest green center text-gray-20">
                    <p>rest</p>
                </div>
            </div>

        </div>

        <!-- Grid Layout examples -->
        <div class="row-padding">

            <div class="col m4">

                <div class="col s6">
                    <div class="col s12 orange" style="width:92%;height:125px;margin-right:10px"></div>
                </div>

                <div class="col s6">
                    <div class="col s12 green" style="height:75px;margin-bottom:10px"></div>
                    <div class="col s6 green" style="height:40px;"></div>
                    <div class="col s6 black" style="height:40px"></div>
                </div>

            </div>

            <div class="col m4">

                <div class="col s3">
                    <div class="col s12 orange" style="width:85%;height:126px;margin-right:20px"></div>
                </div>

                <div class="col s6">
                    <div class="col s12 green" style="height:50px;margin-bottom:10px"></div>
                    <div class="col s6 green" style="height:31px;"></div>
                    <div class="col s6 black" style="height:31px;margin-bottom:10px"></div>

                    <div class="col s4 green" style="height:25px;"></div>
                    <div class="col s4 black" style="height:25px"></div>
                    <div class="col s4 green" style="height:25px"></div>
                </div>

                <div class="col s3">
                    <div class="col s12 orange" style="width:85%;height:126px;margin-left:10px"></div>
                </div>

            </div>

            <div class="col m4">

                <div class="col s12">
                    <div class="col s12 orange" style="height:36px;margin-bottom:10px"></div>
                </div>

                <div class="col s12">
                    <div class="col s12 green" style="height:30px;margin-bottom:10px"></div>
                    <div class="col s8 green" style="height:18px;"></div>
                    <div class="col s4 black" style="height:18px;margin-bottom:10px"></div>

                    <div class="col s3 green" style="height:15px;"></div>
                    <div class="col s3 black" style="height:15px"></div>
                    <div class="col s3 green" style="height:15px"></div>
                    <div class="col s3 black" style="height:15px"></div>
                </div>

            </div>

        </div>

        <p>Clean.CSS also supports a
            <a href="#">12 column mobile-first fluid grid</a>
            with small, medium, and large classes.</p>

    </div>
</template>

<script>
import {debounce} from "lodash";

import Alert from "@/components/clean/Alert.vue";
import Dropdown from "@/components/clean/Dropdown.vue";
import Modal from "@/components/clean/Modal.vue";

import snowTops from '@/assets/images/img_snowtops.jpg';
import imageLights from '@/assets/images/img_lights.jpg';
import imageForest from '@/assets/images/img_forest.jpg';
import imageMountains from '@/assets/images/img_mountains.jpg';
import imageNature from '@/assets/images/img_nature.jpg';
import imageWorkshop from '@/assets/images/img_workshop.jpg';
import demoVideo from '@/assets/videos/GNOME-Workspace-Switch.mp4';
import avatar2 from '@/assets/images/img_avatar2.png';
import avatar5 from '@/assets/images/img_avatar5.png';
import avatar3 from '@/assets/images/img_avatar3.png';
import avatar6 from '@/assets/images/img_avatar6.png';


export default {
    name: "Home",
    components: {
        Alert,
        Dropdown,
        Modal,
    },

    props: [
        'message'
    ],

    data() {
        return {
            snowTops,
            imageLights,
            imageForest,
            imageMountains,
            imageNature,
            imageWorkshop,
            demoVideo,
            avatar2,
            avatar3,
            avatar5,
            avatar6,
            scrollTop: 0,
            threshold: 100,
        }
    },

    mounted() {
        window.addEventListener("wheel",
            this.setScrollToTop);
    },
    beforeMount() {
        window.removeEventListener("wheel", this.setScrollToTop);
    },


    methods: {
        scrollToTop() {
            this.scrollTop = 0;
            document.body.scrollTop = 0;
        },

        showScrollToTopButton() {
            return this.scrollTop > this.threshold
        },

        setScrollToTop: debounce(function () {
            this.scrollTop = document.body.scrollTop;
            console.log(document.body.scrollTop);
        }, 300),

    },


}
</script>

<style scoped lang="sass">

</style>
