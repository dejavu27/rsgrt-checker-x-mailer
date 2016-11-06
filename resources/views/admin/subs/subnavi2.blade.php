                        <div class="box box-primary">
                              <div class="box-header with-border">
                                    <h3 class="box-title">Navigator</h3>
                                    <div class="box-tools pull-right">
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                              </div>
                              <div class="box-body">
                                    <ul class="nav nav-pills nav-stacked">
                                      <li role="presentation" @if(isset($subnavi) == false) class="active" @endif><a href="{{ url('/email/bugs') }}">Report Form</a></li>
                                      <li role="presentation" @if(isset($subnavi) && $subnavi == 'rl') class="active" @endif><a href="{{ url('/email/bugs/list') }}">Report List</a></li>
                                      <li role="presentation" @if(isset($subnavi) && $subnavi == 'dar') class="active" @endif><a href="{{ url('/email/bugs/delete/all') }}">Delete All Report</a></li>
                                    </ul>
                              </div>
                        </div>