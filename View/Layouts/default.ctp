<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php
            if(!empty($title_for_layout)) {
                echo $title_for_layout . ' @ ';
            }
            ?>台南淹水地圖
        </title><?php
        if(!empty($meta_for_layout)) {
            echo $this->Html->meta('description', $meta_for_layout);
        } else {
            echo $this->Html->meta('description', '台南淹水地圖 希望蒐集網路上回報的淹水情況');
        }
        echo $this->Html->meta(array('property' => 'og:image', 'content' => $this->Html->url('/img/og_image.png', true)));
        echo $this->Html->meta('icon');
        echo $this->Html->css('jquery-ui');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('default');
        echo $this->Html->script('jquery');
        echo $this->Html->script('jquery-ui');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('olc');
        echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <div class="container">
            <div id="header">
                <h1><?php echo $this->Html->link('台南淹水地圖', '/'); ?></h1>
            </div>
            <div id="content">
                <div class="btn-group">
                    <?php if ($this->Session->read('Auth.User.id')) { ?>
                        <?php echo $this->Html->link('Points', '/admin/points', array('class' => 'btn btn-default')); ?>
                        <?php echo $this->Html->link('Tags', '/admin/tags', array('class' => 'btn btn-default')); ?>
                        <?php echo $this->Html->link('point_logs', '/admin/point_logs', array('class' => 'btn btn-default')); ?>
                        <?php echo $this->Html->link('Members', '/admin/members', array('class' => 'btn btn-default')); ?>
                        <?php echo $this->Html->link('Groups', '/admin/groups', array('class' => 'btn btn-default')); ?>
                        <?php echo $this->Html->link('Logout', '/members/logout', array('class' => 'btn btn-default')); ?>
                    <?php }; ?>
                    <?php
                    if (!empty($actions_for_layout)) {
                        foreach ($actions_for_layout as $title => $url) {
                            echo $this->Html->link($title, $url, array('class' => 'btn btn-default'));
                        }
                    }
                    ?>
                </div>

                <?php echo $this->Session->flash(); ?>
                <div id="viewContent"><?php echo $content_for_layout; ?></div>
                <div class="clearfix"></div>
            </div>
            <div id="footer">
                <hr />
                <?php echo $this->Html->link('江明宗 . 政 . 路過', 'http://k.olc.tw/', array('target' => '_blank')); ?>
                | <?php echo $this->Html->link('source', 'https://github.com/kiang/water', array('target' => '_blank')); ?>
                <?php if (!$this->Session->read('Auth.User.id')) { ?>
                    | <?php echo $this->Html->link('Login', '/members/login', array('class' => 'btn btn-default')); ?>
                <?php } ?>
            </div>
        </div>
        <?php
        echo $this->element('sql_dump');
        ?>
    </body>
</html>