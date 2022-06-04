<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><META http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>
<style>
.cust-mainbg{background: #ECF0F5; min-height: 100vh}
.cust-wrapper{width: 100%; margin: 0 auto}

.mT40{margin-top: 40px}
.mB40{margin-bottom: 40px}
.mR20{margin-right: 20px}

.cust-addbull button{width: 50%; margin-top: 5px; padding: 10px; font-size: 20px; font-weight: 600; background: #4DA8B0}
.cust-pos{position: relative; top: -30px}
.box-danger2{border-top: 5px solid #0aa8b0; padding: 0 10px;}

.box-header h3{font-size: 26px!important; margin: 20px 0!important;}
.btn-success{background: #c13033; border-color: #c13033 }
.btn-success .fa{padding-right: 10px} 
.error{color:#ff0000;}
.mr5{margin-right:5px; margin-bottom:5px; border:2px solid #fff;}

@media only screen and (max-width : 767px) {
.cust-wrapper{width: 100%;}
}
.card {
  position: relative;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #ffffff;
  background-clip: border-box;
  border: 0 solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
  box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
  margin-bottom: 1rem;
}
}

.card > hr {
  margin-right: 0;
  margin-left: 0;
}

.card > .list-group:first-child .list-group-item:first-child {
  border-top-left-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
}

.card > .list-group:last-child .list-group-item:last-child {
  border-bottom-right-radius: 0.25rem;
  border-bottom-left-radius: 0.25rem;
}

.card-body {
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
  padding: 1.25rem;
}

.card-title {
  margin-bottom: 0.75rem;
}

.card-subtitle {
  margin-top: -0.375rem;
  margin-bottom: 0;
}

.card-text:last-child {
  margin-bottom: 0;
}

.card-link:hover {
  text-decoration: none;
}

.card-link + .card-link {
  margin-left: 1.25rem;
}

.card-header {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  background-color: rgba(0, 0, 0, 0.03);
  border-bottom: 0 solid rgba(0, 0, 0, 0.125);
}

.card-header:first-child {
  border-radius: calc(0.25rem - 0) calc(0.25rem - 0) 0 0;
}

.card-header + .list-group .list-group-item:first-child {
  border-top: 0;
}

.card-footer {
  padding: 0.75rem 1.25rem;
  background-color: rgba(0, 0, 0, 0.03);
  border-top: 0 solid rgba(0, 0, 0, 0.125);
}

.card-footer:last-child {
  border-radius: 0 0 calc(0.25rem - 0) calc(0.25rem - 0);
}

.card-header-tabs {
  margin-right: -0.625rem;
  margin-bottom: -0.75rem;
  margin-left: -0.625rem;
  border-bottom: 0;
}

.card-header-pills {
  margin-right: -0.625rem;
  margin-left: -0.625rem;
}

.card-img-overlay {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1.25rem;
}

.card-img {
  width: 100%;
  border-radius: calc(0.25rem - 0);
}

.card-img-top {
  width: 100%;
  border-top-left-radius: calc(0.25rem - 0);
  border-top-right-radius: calc(0.25rem - 0);
}

.card-img-bottom {
  width: 100%;
  border-bottom-right-radius: calc(0.25rem - 0);
  border-bottom-left-radius: calc(0.25rem - 0);
}

.card-deck {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
}

.card-deck .card {
  margin-bottom: 7.5px;
}

@media (min-width: 576px) {
  .card-deck {
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
    margin-right: -7.5px;
    margin-left: -7.5px;
  }
  .card-deck .card {
    display: -ms-flexbox;
    display: flex;
    -ms-flex: 1 0 0%;
    flex: 1 0 0%;
    -ms-flex-direction: column;
    flex-direction: column;
    margin-right: 7.5px;
    margin-bottom: 0;
    margin-left: 7.5px;
  }
}

.card-group {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-direction: column;
  flex-direction: column;
}

.card-group > .card {
  margin-bottom: 7.5px;
}

@media (min-width: 576px) {
  .card-group {
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
  }
  .card-group > .card {
    -ms-flex: 1 0 0%;
    flex: 1 0 0%;
    margin-bottom: 0;
  }
  .card-group > .card + .card {
    margin-left: 0;
    border-left: 0;
  }
  .card-group > .card:not(:last-child) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }
  .card-group > .card:not(:last-child) .card-img-top,
  .card-group > .card:not(:last-child) .card-header {
    border-top-right-radius: 0;
  }
  .card-group > .card:not(:last-child) .card-img-bottom,
  .card-group > .card:not(:last-child) .card-footer {
    border-bottom-right-radius: 0;
  }
  .card-group > .card:not(:first-child) {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }
  .card-group > .card:not(:first-child) .card-img-top,
  .card-group > .card:not(:first-child) .card-header {
    border-top-left-radius: 0;
  }
  .card-group > .card:not(:first-child) .card-img-bottom,
  .card-group > .card:not(:first-child) .card-footer {
    border-bottom-left-radius: 0;
  }
}

.card-columns .card {
  margin-bottom: 0.75rem;
}
.bg-light {
    background-color: #f8f9fa!important;
}
.product-image {
  max-width: 100%;
  height: auto;
  width: 100%;
}

.product-image-thumbs {
  -ms-flex-align: stretch;
  align-items: stretch;
  display: -ms-flexbox;
  display: flex;
  margin-top: 2rem;
}

.product-image-thumb {
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075);
  border-radius: 0.25rem;
  background-color: #ffffff;
  border: 1px solid #dee2e6;
  display: -ms-flexbox;
  display: flex;
  margin-right: 1rem;
  max-width: 7rem;
  padding: 0.5rem;
}

.product-image-thumb img {
  max-width: 100%;
  height: auto;
  -ms-flex-item-align: center;
  align-self: center;
}

.product-image-thumb:hover {
  opacity: 0.5;
}
.btn:not(:disabled):not(.disabled).active, .btn:not(:disabled):not(.disabled):active {
    box-shadow: none;
}
.btn-group>.btn-group:not(:last-child)>.btn, .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.prod{background-color: #f4f4f4;
    color: #444;
    border: 1px solid #ddd; 
    padding:6px 12px;
}
.pad{padding:4px 8px;}

@media (min-width: 576px) {
  .card-columns {
    -webkit-column-count: 3;
    -moz-column-count: 3;
    column-count: 3;
    -webkit-column-gap: 1.25rem;
    -moz-column-gap: 1.25rem;
    column-gap: 1.25rem;
    orphans: 1;
    widows: 1;
  }
  .card-columns .card {
    display: inline-block;
    width: 100%;
  }
}
</style>
<div>
<div>
    <a href="http://index2.html" target="_blank">
      <span><b>A</b>LT</span>
      <span><b>Admin</b>LTE</span>
    </a>
      <a href="#0.1_">
        <span>Toggle navigation</span>
      </a>
      <div>
        <ul>
          <li>
            <a href="#0.1_">
              <i></i>
              <span>4</span>
            </a>
            <ul>
              <li>You have 4 messages</li>
              <li>
                <ul>
                  <li>
                    <a href="#0.1_">
                      <div>
                        <img src="http://dist/img/user2-160x160.jpg" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <div>
                        <img src="http://dist/img/user3-128x128.jpg" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <div>
                        <img src="http://dist/img/user4-128x128.jpg" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <div>
                        <img src="http://dist/img/user3-128x128.jpg" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <div>
                        <img src="http://dist/img/user4-128x128.jpg" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li><a href="#0.1_">See All Messages</a></li>
            </ul>
          </li>
          <li>
            <a href="#0.1_">
              <i></i>
              <span>10</span>
            </a>
            <ul>
              <li>You have 10 notifications</li>
              <li>
                
                <ul>
                  <li>
                    <a href="#0.1_">
                      <i></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <i></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <i></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <i></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <i></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li><a href="#0.1_">View all</a></li>
            </ul>
          </li>
          <li>
            <a href="#0.1_">
              <i></i>
              <span>9</span>
            </a>
            <ul>
              <li>You have 9 tasks</li>
              <li>
                <ul>
                  <li>
                    <a href="#0.1_">
                      <h3>
                        Design some buttons
                        <small>20%</small>
                      </h3>
                      <div>
                        <div style="width:20%">
                          <span>20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <h3>
                        Create a nice theme
                        <small>40%</small>
                      </h3>
                      <div>
                        <div style="width:40%">
                          <span>40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <h3>
                        Some task I need to do
                        <small>60%</small>
                      </h3>
                      <div>
                        <div style="width:60%">
                          <span>60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#0.1_">
                      <h3>
                        Make beautiful transitions
                        <small>80%</small>
                      </h3>
                      <div>
                        <div style="width:80%">
                          <span>80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#0.1_">View all tasks</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#0.1_">
              <img src="http://dist/img/user2-160x160.jpg" alt="User Image">
              <span>Alexander Pierce</span>
            </a>
            <ul>
              <li>
                <img src="http://dist/img/user2-160x160.jpg" alt="User Image">
                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <li>
                <div>
                  <div>
                    <a href="#0.1_">Followers</a>
                  </div>
                  <div>
                    <a href="#0.1_">Sales</a>
                  </div>
                  <div>
                    <a href="#0.1_">Friends</a>
                  </div>
                </div>
              </li>
              <li>
                <div>
                  <a href="#0.1_">Profile</a>
                </div>
                <div>
                  <a href="#0.1_">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <a href="#0.1_"><i></i></a>
          </li>
        </ul>
      </div>
      <div>
        <div>
          <img src="http://dist/img/user2-160x160.jpg" alt="User Image">
        </div>
        <div>
          <p>Alexander Pierce</p>
          <a href="#0.1_"><i></i> Online</a>
        </div>
      </div>
      
      <form action="#0.1_" method="get" target="_blank" onsubmit="try {return window.confirm(&quot;This form may not function properly due to certain security constraints.\nContinue?&quot;);} catch (e) {return false;}">
        <div>
          <input type="text" name="q">
          <span>
                <button type="submit" name="search"><i></i>
                </button>
              </span>
        </div>
      </form>
      <ul>
        <li>MAIN NAVIGATION</li>
        <li>
          <a href="#0.1_">
            <i></i> <span>Dashboard</span>
            <span>
              <i></i>
            </span>
          </a>
          <ul>
            <li><a href="http://index.html" target="_blank"><i></i> Dashboard v1</a></li>
            <li><a href="http://index2.html" target="_blank"><i></i> Dashboard v2</a></li>
          </ul>
        </li>
        <li>
          <a href="#0.1_">
            <i></i>
            <span>Layout Options</span>
            <span>
              <span>4</span>
            </span>
          </a>
          <ul>
            <li><a href="http://pages/layout/top-nav.html" target="_blank"><i></i> Top Navigation</a></li>
            <li><a href="http://pages/layout/boxed.html" target="_blank"><i></i> Boxed</a></li>
            <li><a href="http://pages/layout/fixed.html" target="_blank"><i></i> Fixed</a></li>
            <li><a href="http://pages/layout/collapsed-sidebar.html" target="_blank"><i></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
        <li>
          <a href="http://pages/widgets.html" target="_blank">
            <i></i> <span>Widgets</span>
            <span>
              <small>new</small>
            </span>
          </a>
        </li>
        <li>
          <a href="#0.1_">
            <i></i>
            <span>Charts</span>
            <span>
              <i></i>
            </span>
          </a>
          <ul>
            <li><a href="http://pages/charts/chartjs.html" target="_blank"><i></i> ChartJS</a></li>
            <li><a href="http://pages/charts/morris.html" target="_blank"><i></i> Morris</a></li>
            <li><a href="http://pages/charts/flot.html" target="_blank"><i></i> Flot</a></li>
            <li><a href="http://pages/charts/inline.html" target="_blank"><i></i> Inline charts</a></li>
          </ul>
        </li>
        <li>
          <a href="#0.1_">
            <i></i>
            <span>UI Elements</span>
            <span>
              <i></i>
            </span>
          </a>
          <ul>
            <li><a href="http://pages/UI/general.html" target="_blank"><i></i> General</a></li>
            <li><a href="http://pages/UI/icons.html" target="_blank"><i></i> Icons</a></li>
            <li><a href="http://pages/UI/buttons.html" target="_blank"><i></i> Buttons</a></li>
            <li><a href="http://pages/UI/sliders.html" target="_blank"><i></i> Sliders</a></li>
            <li><a href="http://pages/UI/timeline.html" target="_blank"><i></i> Timeline</a></li>
            <li><a href="http://pages/UI/modals.html" target="_blank"><i></i> Modals</a></li>
          </ul>
        </li>
        <li>
          <a href="#0.1_">
            <i></i> <span>Forms</span>
            <span>
              <i></i>
            </span>
          </a>
          <ul>
            <li><a href="http://pages/forms/general.html" target="_blank"><i></i> General Elements</a></li>
            <li><a href="http://pages/forms/advanced.html" target="_blank"><i></i> Advanced Elements</a></li>
            <li><a href="http://pages/forms/editors.html" target="_blank"><i></i> Editors</a></li>
          </ul>
        </li>
        <li>
          <a href="#0.1_">
            <i></i> <span>Tables</span>
            <span>
              <i></i>
            </span>
          </a>
          <ul>
            <li><a href="http://pages/tables/simple.html" target="_blank"><i></i> Simple tables</a></li>
            <li><a href="http://pages/tables/data.html" target="_blank"><i></i> Data tables</a></li>
          </ul>
        </li>
        <li>
          <a href="http://pages/calendar.html" target="_blank">
            <i></i> <span>Calendar</span>
            <span>
              <small>3</small>
              <small>17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="http://pages/mailbox/mailbox.html" target="_blank">
            <i></i> <span>Mailbox</span>
            <span>
              <small>12</small>
              <small>16</small>
              <small>5</small>
            </span>
          </a>
        </li>
        <li>
          <a href="#0.1_">
            <i></i> <span>Examples</span>
            <span>
              <i></i>
            </span>
          </a>
          <ul>
            <li><a href="http://pages/examples/invoice.html" target="_blank"><i></i> Invoice</a></li>
            <li><a href="http://pages/examples/profile.html" target="_blank"><i></i> Profile</a></li>
            <li><a href="http://pages/examples/login.html" target="_blank"><i></i> Login</a></li>
            <li><a href="http://pages/examples/register.html" target="_blank"><i></i> Register</a></li>
            <li><a href="http://pages/examples/lockscreen.html" target="_blank"><i></i> Lockscreen</a></li>
            <li><a href="http://pages/examples/404.html" target="_blank"><i></i> 404 Error</a></li>
            <li><a href="http://pages/examples/500.html" target="_blank"><i></i> 500 Error</a></li>
            <li><a href="http://pages/examples/blank.html" target="_blank"><i></i> Blank Page</a></li>
            <li><a href="http://pages/examples/pace.html" target="_blank"><i></i> Pace Page</a></li>
          </ul>
        </li>
        <li>
          <a href="#0.1_">
            <i></i> <span>Multilevel</span>
            <span>
              <i></i>
            </span>
          </a>
          <ul>
            <li><a href="#0.1_"><i></i> Level One</a></li>
            <li>
              <a href="#0.1_"><i></i> Level One
                <span>
                  <i></i>
                </span>
              </a>
              <ul>
                <li><a href="#0.1_"><i></i> Level Two</a></li>
                <li>
                  <a href="#0.1_"><i></i> Level Two
                    <span>
                      <i></i>
                    </span>
                  </a>
                  <ul>
                    <li><a href="#0.1_"><i></i> Level Three</a></li>
                    <li><a href="#0.1_"><i></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#0.1_"><i></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs" target="_blank"><i></i> <span>Documentation</span></a></li>
        <li>LABELS</li>
        <li><a href="#0.1_"><i></i> <span>Important</span></a></li>
        <li><a href="#0.1_"><i></i> <span>Warning</span></a></li>
        <li><a href="#0.1_"><i></i> <span>Information</span></a></li>
      </ul>
  <div>
      <h1>
        Product Detail
      </h1>
      <ol>
        <li><a href="#0.1_"><i></i> Home</a></li>
        <li>Dashboard</li>
      </ol>
      <div>
        <div>
          <div>
            <div>
              <h3>Product Name &amp; Images</h3>
              <div>
                <img src="http://dist/img/prod-1.jpg" alt="Product Image">
              </div>
              <div>
                <div><img src="http://dist/img/prod-1.jpg" alt="Product Image"></div>
                <div><img src="http://dist/img/prod-2.jpg" alt="Product Image"></div>
                <div><img src="http://dist/img/prod-3.jpg" alt="Product Image"></div>
                <div><img src="http://dist/img/prod-4.jpg" alt="Product Image"></div>
                <div><img src="http://dist/img/prod-5.jpg" alt="Product Image"></div>
              </div>
            </div>
            <div>
              <h3>Product Name</h3>
              <p>Short Description here Raw denim you probably haven&#39;t heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
              <hr>
              <h2><b>Amaze</b></h2>
                <p><b>MRP: </b>Rs1200 </p>
                <p><b>Price: </b>Rs800 </p>
                <p><b>SKU : </b>abcd1234 </p>
                <p><b>Height : </b>20m </p>
                <p><b>Width : </b>30m </p>
                <p><b>Color : </b>White </p>
                <p><b>Generic Name : </b>leailabunav</p>
                <p><b>Brand Name : </b>livestoc </p>
                <p><b>Unit : </b>Unknown </p>
                <p><b>Package Rate: </b>Rs1200 </p>
                <p><b>Salt Composition : </b>Unknown</p>
              <div>
                <h4>
                  Price: Rs 800
                </h4>
                <h4>
                  <small>MRP: Rs 1200 </small>
                </h4>
              </div>
            </div>
          </div>
          <div>
              <div>
            <h4>Product Description</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus purus sed venenatis. Vivamus varius metus quam, id dapibus velit mattis eu. Praesent et semper risus. Vestibulum erat erat, condimentum at elit at, bibendum placerat orci. Nullam gravida velit mauris, in pellentesque urna pellentesque viverra. Nullam non pellentesque justo, et ultricies neque. Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque interdum efficitur nunc vitae consectetur. Suspendisse venenatis, tortor non convallis interdum, urna mi molestie eros, vel tempor justo lacus ac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel metus.</p>
          </div>
              </div>
        </div>
      </div>
  </div>
    <div>
      <b>Version</b> 2.4.18
    </div>
    <strong>Copyright © 2014-2019 <a href="https://adminlte.io" target="_blank">AdminLTE</a>.</strong> All rights
    reserved.
    <ul>
      <li><a href="#0.1_control-sidebar-home-tab"><i></i></a></li>
      <li><a href="#0.1_control-sidebar-settings-tab"><i></i></a></li>
    </ul>
    <div>
      <div>
        <h3>Recent Activity</h3>
        <ul>
          <li>
            <a>
              <i></i>
              <div>
                <h4>Langdon&#39;s Birthday</h4>
                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a>
              <i></i>
              <div>
                <h4>Frodo Updated His Profile</h4>
                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a>
              <i></i>
              <div>
                <h4>Nora Joined Mailing List</h4>
                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a>
              <i></i>
              <div>
                <h4>Cron Job 254 Executed</h4>
                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <h3>Tasks Progress</h3>
        <ul>
          <li>
            <a>
              <h4>
                Custom Template Design
                <span>70%</span>
              </h4>
              <div>
                <div style="width:70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a>
              <h4>
                Update Resume
                <span>95%</span>
              </h4>
              <div>
                <div style="width:95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a>
              <h4>
                Laravel Integration
                <span>50%</span>
              </h4>

              <div>
                <div style="width:50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a>
              <h4>
                Back End Framework
                <span>68%</span>
              </h4>
              <div>
                <div style="width:68%"></div>
              </div>
            </a>
          </li>
        </ul>
      </div>
      <div>Stats Tab Content</div>
      <div>
        <form method="post" target="_blank" onsubmit="try {return window.confirm(&quot;This form may not function properly due to certain security constraints.\nContinue?&quot;);} catch (e) {return false;}">
          <h3>General Settings</h3>
          <div>
            <label>
              Report panel usage
              <input type="checkbox" checked>
            </label>
            <p>
              Some information about this general settings option
            </p>
          </div>
          <div>
            <label>
              Allow mail redirect
              <input type="checkbox" checked>
            </label>
            <p>
              Other sets of options are available
            </p>
          </div>
          <div>
            <label>
              Expose author name in posts
              <input type="checkbox" checked>
            </label>
            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <h3>Chat Settings</h3>
          <div>
            <label>
              Show me as online
              <input type="checkbox" checked>
            </label>
          </div>
          <div>
            <label>
              Turn off notifications
              <input type="checkbox">
            </label>
          </div>
          <div>
            <label>
              Delete chat history
              <a><i></i></a>
            </label>
          </div>
        </form>
      </div>
    </div>
  <div></div>
</div>
</div>
</body></html>