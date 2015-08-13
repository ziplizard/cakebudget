<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Myers Budget</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php
            if ($this->Session->read('Auth.User'))
            {
                $class = ($this->request->controller == 'tests' && $this->request->action == 'balance') ? 'active' : '';
                echo '<li class="'.$class.'">';
                echo $this->Html->link(date('F').' Balance', '/tests/balance');
                echo '</li>';
                
                $class = ($this->request->controller == 'tests' && $this->request->action == 'lines') ? 'active' : '';
                echo '<li class="'.$class.'">';
                echo $this->Html->link('Budget Lines', '/tests/lines');
                echo '</li>';
            }
            ?>
          </ul>
          
            <?php
            if ($this->Session->read('Auth.User'))
            {
                echo '<div class="logout">';
                echo 'Welcome '.$this->Session->read('Auth.User.username').'! &nbsp;';
                echo '<a href="/users/logout" class="btn btn-primary">Logout</a>';
                echo '</div>';
            }
            else
            {
                /* For some reason the padding with this is messed up ??
                echo $this->Form->create('User', array('action'=>'login', 'class'=>'navbar-form navbar-right'));
                echo $this->Form->input('username', array('placeholder'=>'Username', 'class'=>'form-control', 'div'=>'form-group', 'label'=>false));
                echo $this->Form->input('password', array('placeholder'=>'Password', 'class'=>'form-control', 'div'=>'form-group', 'label'=>false));
                echo $this->Form->submit('Sign In', array('class'=>'btn btn-success', 'div' => false));                
                echo $this->Form->end();
                */
                ?>
                <form accept-charset="utf-8" method="post" id="UserLoginForm" class="navbar-form navbar-right" action="/users/login">
                <div style="display:none;">
                    <input type="hidden" value="POST" name="_method">
                </div>
                <div class="form-group required">
                    <input type="text" required="required" id="UserUsername" maxlength="50" class="form-control" placeholder="Username" name="data[User][username]">
                </div>
                <div class="form-group required">
                    <input type="password" required="required" id="UserPassword" class="form-control" placeholder="Password" name="data[User][password]">
                </div>
                <input type="submit" value="Sign In" class="btn btn-success">
                </form>
                <?php
            }
            ?>
          
        </div><!--/.navbar-collapse -->
    </div>
</div>