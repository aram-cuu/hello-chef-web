<?php
    require_once __DIR__ . '/../library/Config.php';
    $config = new Config();
?>


    <main>
        <section>
            <div class="container">
                <div class="col-sm-12" style="text-align: center;">
                    <h1>Welcome to
                        <span style="text-transform: uppercase; font-weight: bold;">
                            <?php echo $config->getEnvironment();?>
                        </span>
                    </h1>
                </div>
            </div>
            <div class="container">

                <div class="col-sm-12 col-md-6 hidden-xs hidden-sm">
                    <br>
                    <?php if($config->isDevelopment()): ?>
                        <img class="center-block img-responsive" src="img/wario.jpg" alt="development">
                    <?php else: ?>
                        <img class="center-block img-responsive" src="img/mario.png" alt="production">
                    <?php endif; ?>
                </div>

                <div class="col-sm-12 col-md-6">
                    <header class="section-header text-left">
                        <h2>List your top favorite <?php echo $config->getTopicContext();?></h2>
                    </header>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody id="topic-body">
                            </tbody>
                        </table>
                    </div>
                    <form id="topic-form" class="form" action="javascript:void(0);">
                        <label for="topic"></label>
                        <input name="topic" id="topic" />
                        <button id="submit-topic" class="btn btn-primary" type="button">Add</button>
                    </form>
                </div>

            </div>
        </section>
    </main>

    <script>
        $(document).ready(function(){
            function loadTopics() {
                $('#topic-body').empty();
                $.ajax({
                    type: "POST",
                    url: 'fetch-topics.php',
                    success: function(response){
                        $.each(response, function(index, value){
                            var row = "<tr><td>"+(index+1)+"</td><td>"+value.topic_name+"</tr>";
                            $('#topic-body').append(row);
                        });
                    }
                }).done()
                    .fail(function(){
                        alert('An error ocurred, you should probably set the path of the webserver');
                    });
            }
            loadTopics();
            $('#submit-topic').click(function(){
                if($('#topic').val().length === 0 ){
                    return;
                }
                $('#submit-topic').prop('disabled',true);
                $.ajax({
                    type: "POST",
                    url: 'save-topic.php',
                    data : $('#topic-form').serialize(),
                    success: function(){
                        $('#submit-topic').prop('disabled',false);
                    }
                }).done(function(){
                    loadTopics();
                    $('#topic').val('');
                })
                    .fail(function(){
                        alert('An error ocurred, you should probably set the path of the webserver');
                    });
            })
        });
    </script>