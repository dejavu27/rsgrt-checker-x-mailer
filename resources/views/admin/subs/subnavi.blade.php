                        <div class="box box-primary">
                              <div class="box-header with-border">
                                    <h3 class="box-title">Navigator</h3>
                                    <div class="box-tools pull-right">
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                              </div>
                              <div class="box-body">
                                    <ul class="nav nav-pills nav-stacked">
                                      <li role="presentation" @if($subnavi == 'ce') class="active" @endif><a href="{{ url('/email/create') }}">CREATE EMAIL</a></li>
                                      <li role="presentation" @if($subnavi == 'el') class="active" @endif><a href="{{ url('/email/list') }}">EMAIL LIST</a></li>
                                      <li role="presentation"><a href="https://ano.anotherme.io:2096/" target="_blank">WEBMAIL LOGIN</a></li>
                                    </ul>
                              </div>
                        </div>