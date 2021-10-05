    <div class="widget" style="">
        <h2>Batch Efficiency Group Wise Statistics<a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Batch Efficiency Group Wise Statistics"><img src="{{ asset('images/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
        <div class="widget-scroller">
            <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="10" class="table table-bordered">
                <tr>
                    <th rowspan="2">Group</th>
                    <th rowspan="2" align="center">Total Customers</th>
                    <th colspan="2" align="center">Customers Moved to Next Stage</th>
                    <th rowspan="2" align="center">Group Efficiency</th>
                </tr>
                <tr>
                    <th>On That Date</th>
                    <th>On Subsequent Dates</th>
                </tr>
                @if (!empty($batch_efficiency_stats))
                @foreach ($batch_efficiency_stats as $group_stats)
                <tr>
                    <th>{{ $group_stats['group_name'] }}</th>
                    <td align="center"><span style="color:#000">{{ $group_stats['total_customers'] }}</span></td>
                    <td align="center"><span style="color:#000">{{ $group_stats['on_date_converted_customers'] }}</span></td>
                    <td align="center"><span style="color:#000">{{ $group_stats['subsequent_dates_converted_customers'] }}</span></td>
                    <td align="center"><span style="color:#000">{{ $group_stats['group_efficiency'] }}</span></td>

                </tr>
                @endforeach
                @else
                
                <tr>
                    <td>
                        <center>
                            <h1>No Data Found</h1>
                        </center>
                    </td>
                </tr>
                @endif
            </table>
        </div>
    </div>
