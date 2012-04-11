						<tr class="grid_row">
							<td class="table_row_{odd_factor}" valign="top">{item_checkbox:name=pmsg_d;id={id}}</td>
							<td align="left" class="table_row_{odd_factor}">{href:tpl=std;page=./profile.html?login[eq]{author};raw_text={author}}{guest_author}</td>
							<td align="left" class="table_row_{odd_factor}">{href:tpl=std;page=./profile.html?login[eq]{recipient};raw_text={recipient}}</td>
							<td align="left" class="table_row_{odd_factor} pointer" id="record_view_opener_{id}_in"><span class="{if:condition={read};then=read;else=not_read}">{subject}</span</td>
							<td align="left" class="table_row_{odd_factor}"><nobr>{creation_date}</nobr>{dialog:on_open=ultimix.pmsg.SetRead( {id} );modal=false;cancel=true;selector=#record_view_{id}_in;opener=#record_view_opener_{id}_in}{static_content:package_name=pmsg::pmsg_view;template=record_view_in.tpl}</td>
						</tr>