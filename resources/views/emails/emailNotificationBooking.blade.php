<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
	xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
	<title>Booking Alat Email</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<style type="text/css">
		#outlook a {
			padding: 0;
		}

		body {
			margin: 0;
			padding: 0;
			-webkit-text-size-adjust: 100%;
			-ms-text-size-adjust: 100%;
		}

		table,
		td {
			border-collapse: collapse;
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
		}

		img {
			border: 0;
			height: auto;
			line-height: 100%;
			outline: none;
			text-decoration: none;
			-ms-interpolation-mode: bicubic;
		}

		p {
			display: block;
			margin: 13px 0;
		}

		.header-title {
			font-family: Assistant, Helvetica, Arial, sans-serif;
			font-size: 20px;
			font-weight: 600;
			line-height: 32px;
			text-align: center;
			color: #ffffff;
			margin-top: 0;
			margin-bottom: 0;
		}

		@media only screen and (min-width: 480px) {
			.mj-column-per-100 {
				width: 100% !important;
				max-width: 100%;
			}
		}

		@media only screen and (max-width: 480px) {
			table.mj-full-width-mobile {
				width: 100% !important;
			}

			td.mj-full-width-mobile {
				width: auto !important;
			}
		}
	</style>
</head>

<body style="word-spacing: normal">
	<div style="">
		<div style="
					background: #101939;
					background-color: #101939;
					margin: 0px auto;
					max-width: 600px;
				">
			<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
				style="background: #101939; background-color: #101939; width: 100%">
				<tbody>
					<tr>
						<td style="
									direction: ltr;
									font-size: 0px;
									padding: 20px 0;
									text-align: center;
								">
							<div class="mj-column-per-100 mj-outlook-group-fix" style="
										font-size: 0px;
										text-align: left;
										direction: ltr;
										display: inline-block;
										vertical-align: top;
										width: 100%;
									">
								<table border="0" cellpadding="0" cellspacing="0" role="presentation"
									style="vertical-align: top" width="100%">
									<tbody>
										<tr>
											<td align="center" style="
														font-size: 0px;
														padding: 10px 25px;
														word-break: break-word;
													">
												<table border="0" cellpadding="0" cellspacing="0" role="presentation"
													style="
															border-collapse: collapse;
															border-spacing: 0px;
														">
													<tbody>
														<tr>
															<td style="width: 100px">
																<img alt="Logo SMIL" height="auto" src="{{
																			url('email_template/logo_pnj.png')
																		}}" style="
																			border: none;
																			display: block;
																			outline: none;
																			text-decoration: none;
																			height: auto;
																			width: 100%;
																			font-size: 13px;
																		" width="100" />
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>

										<tr>
											<td align="center" style="
														font-size: 0px;
														padding: 10px 25px;
														word-break: break-word;
													">
												<h4 class="header-title">
													Laboratorium Teknik Informatika dan Komputer <br />
													Politeknik Negeri Jakarta
												</h4>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div style="
					background: #ffffff;
					background-color: #ffffff;
					margin: 0px auto;
					max-width: 600px;
				">
			<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
				style="background: #ffffff; background-color: #ffffff; width: 100%">
				<tbody>
					<tr>
						<td style="
									direction: ltr;
									font-size: 0px;
									padding: 20px 0;
									padding-bottom: 0px;
									padding-left: 0px;
									padding-top: 0px;
									text-align: center;
								">
							<div class="mj-column-per-100 mj-outlook-group-fix" style="
										font-size: 0px;
										text-align: left;
										direction: ltr;
										display: inline-block;
										vertical-align: top;
										width: 100%;
									">
								<table border="0" cellpadding="0" cellspacing="0" role="presentation"
									style="vertical-align: top" width="100%">
									<tbody>
										<tr>
											<td align="left" style="
														font-size: 0px;
														padding: 10px 25px;
														padding-top: 50px;
														word-break: break-word;
													">
												<div style="
															font-family: Arial;
															font-size: 14px;
															font-weight: bold;
															line-height: 1;
															text-align: left;
															color: #000000;
														">
													Selamat, {{ $notification->peminjam_name }}
												</div>
											</td>
										</tr>

										<tr>
											<td align="left" style="
														font-size: 0px;
														padding: 10px 25px;
														padding-top: 20px;
														word-break: break-word;
													">
												<div style="
															font-family: Arial;
															font-size: 14px;
															line-height: 25px;
															text-align: left;
															color: #000000;
														">
													Anda telah berhasil melakukan booking peminjaman
													alat pada
													<span style="font-weight: bold">
														{{ $notification->created_at }}
													</span>
													dengan keterangan sebagai berikut :
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="mj-column-per-100 mj-outlook-group-fix" style="
										font-size: 0px;
										text-align: left;
										direction: ltr;
										display: inline-block;
										vertical-align: middle;
										width: 100%;
									">
								<table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
									<tbody>
										<tr>
											<td style="
														border-bottom: 1px dashed #eee;
														vertical-align: middle;
														padding-bottom: 25px;
													">
												<table border="0" cellpadding="0" cellspacing="0" role="presentation"
													style="" width="100%">
													<tbody>
														<tr>
															<td align="left" style="
																		font-size: 0px;
																		padding: 10px 25px;
																		padding-right: 25px;
																		padding-left: 25px;
																		word-break: break-word;
																	">
																<table cellpadding="0" cellspacing="0" width="100%"
																	border="0" style="
																			color: #071c4d;
																			font-family: Assistant, Helvetica, Arial,
																				sans-serif;
																			font-size: 16px;
																			line-height: 28px;
																			table-layout: auto;
																			width: 100%;
																			border: none;
																		">
																	<tr>
																		<td>
																			<strong>ID Peminjaman</strong>
																		</td>
																	</tr>
																	<tr>
																		<td>{{ $peminjaman->id }}</td>
																	</tr>
																	<tr>
																		<td>
																			<strong>Waktu Pengembalian</strong>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			{{ $notification->expected_return_date }}
																		</td>
																	</tr>

																	<tr>
																		<td>
																			<strong>Dosen Penanggung Jawab</strong>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			{{ $notification->in_charge }}
																		</td>
																	</tr>

																	<tr>
																		<td>
																			<strong>Daftar Alat Dipinjam: </strong>
																		</td>
																	</tr>

																	@foreach($peminjaman->detail_peminjaman_model as
																	$detail)
																	<tr>
																		<td>
																			<span style="padding-right: 10px">
																				{{ $loop->index + 1}}
																			</span>
																			@if($peminjaman->pjm_status == 1)
																			{{ $detail->alat_pinjam->alat_name }}
																			@else
																			{{ $detail->barcode_alat.'-'.$detail->barcode_alat_pinjam->alat_model->alat_name }}
																			@endif
																		</td>
																	</tr>
																	@endforeach
																</table>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="mj-column-per-100 mj-outlook-group-fix" style="
										font-size: 0px;
										text-align: left;
										direction: ltr;
										display: inline-block;
										vertical-align: top;
										width: 100%;
									">
								<table border="0" cellpadding="0" cellspacing="0" role="presentation"
									style="vertical-align: top" width="100%">
									<tbody>
										<tr>
											<td align="left" style="
														font-size: 0px;
														padding: 10px 25px;
														word-break: break-word;
													">
												<div style="
															font-family: Arial;
															font-size: 14px;
															line-height: 25px;
															text-align: left;
															color: #000000;
														">
													Perlihatkan email ini kepada staff laboratorium pada
													saat pengambilan alat.
												</div>
											</td>
										</tr>

										<tr>
											<td align="left" style="
														font-size: 0px;
														padding: 10px 25px;
														padding-top: 40px;
														word-break: break-word;
													">
												<div style="
															font-family: Arial;
															font-size: 14px;
															font-weight: bold;
															line-height: 1;
															text-align: left;
															color: #000000;
														">
													Terima Kasih
												</div>
											</td>
										</tr>

										<tr>
											<td align="left" style="
														font-size: 0px;
														padding: 10px 25px;
														padding-bottom: 52px;
														word-break: break-word;
													">
												<div style="
															font-family: Arial;
															font-size: 14px;
															font-weight: bold;
															line-height: 1;
															text-align: left;
															color: #000000;
														">
													Laboratorium Teknik Informatika dan Komputer
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>

</html>