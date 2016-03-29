<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                
                  <li id="profilemenu">
                      <a class="" href="profile.php">
                          <i class="icon_house_alt"></i>
                          <span>Profile</span>
                      </a>
                  </li>
          <?php
          if($result['person_type']=="admin")
          { 
          ?>
          <li id="supervisormenu" class="sub-menu">
              <a href="javascript:;" class="">
                  <i class="icon_document_alt"></i>
                  <span>Supervisor</span>
                  <span class="menu-arrow arrow_carrot-right"></span>
              </a>
              <ul class="sub">
                  <li id="supervisormenuadd"><a class="" href="addsupervisor.php" style="border-top: 1px solid #D7D7D7">Add Supervisor</a></li>                          
                  <li id="supervisormenulist"><a class="" href="listsupervisor.php">Edit Supervisors</a></li>                          
              </ul>
          </li> 
          <li id="skillsmenu" class="sub-menu">
              <a href="javascript:;" class="">
                  <i class="icon_document_alt"></i>
                  <span>Skills</span>
                  <span class="menu-arrow arrow_carrot-right"></span>
              </a>
              <ul class="sub">
                  <li id="skillsmenuadd"><a class="" href="skilladd.php" style="border-top: 1px solid #D7D7D7">Add Skills</a></li>                          
                  <li id="skillsmenulist"><a class="" href="skilllist.php">List Skills</a></li>                          
              </ul>
          </li> 
			<?php /*
          <li id="businessmenu" class="sub-menu">
              <a href="javascript:;" class="">
                  <i class="icon_document_alt"></i>
                  <span>Business</span>
                  <span class="menu-arrow arrow_carrot-right"></span>
              </a>
              <ul class="sub">
                  <li id="businessmenuadd"><a class="" href="businessadd.php">Add Business</a></li>                          
                  <li id="businessmenulist"><a class="" href="businesslist.php">List Business</a></li>                          
              </ul>
          </li>     
			*/ ?>
          <li id="internshipsmenu" class="sub-menu">
              <a href="javascript:;" class="">
                  <i class="icon_document_alt"></i>
                  <span>Internships</span>
                  <span class="menu-arrow arrow_carrot-right"></span>
              </a>
              <ul class="sub">
                  <li id="internshipmenuadd"><a class="" href="addinternship.php">Add Internship</a></li>                          
                  <li id="internshipmenuassign"><a class="" href="assigninternship.php">Assign Internship</a></li>                          
                  <li id="internshipmenulist"><a class="" href="listinternships.php">Edit Internships</a></li>                          
              </ul>
          </li>                         
          <?php 
          }
          ?>
          <?php
          if($result['person_type']=="student")
          { 
          ?>
          <li id="studskillsmenu" class="sub-menu">
              <a href="javascript:;" class="">
                  <i class="icon_document_alt"></i>
                  <span>Skills</span>
                  <span class="menu-arrow arrow_carrot-right"></span>
              </a>
              <ul class="sub">
                  <li id="studskillsmenuadd"><a class="" href="studentskilladd.php" style="border-top: 1px solid #D7D7D7">Add Skills</a></li>                          
                  <li id="studskillsmenulist"><a class="" href="studentskilllist.php">List Skills</a></li>                          
              </ul>
          </li> 
          <li id="appliedinternshipsmenu">
              <a class="" href="studentappliedinternship.php">
                  <i class="icon_document_alt"></i>
                  <span>Applied Internship</span>
              </a>
          </li>
          <li id="internshipsearchmenu">
              <a class="" href="studentinternshipsearch.php">
                  <i class="icon_document_alt"></i>
                  <span>Search Internship</span>
              </a>
          </li>
          <?php 
          }
          ?>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>