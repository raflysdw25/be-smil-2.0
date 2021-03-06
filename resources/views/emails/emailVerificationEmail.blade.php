<!DOCTYPE html>
<html
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:v="urn:schemas-microsoft-com:vml"
	xmlns:o="urn:schemas-microsoft-com:office:office"
>
	<head>
		<title>Verifikasi Email</title>
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
		<div>
			<div
				style="
					background: #101939;
					background-color: #101939;
					margin: 0px auto;
					max-width: 600px;
				"
			>
				<table
					align="center"
					border="0"
					cellpadding="0"
					cellspacing="0"
					role="presentation"
					style="background: #101939; background-color: #101939; width: 100%"
				>
					<tbody>
						<tr>
							<td
								style="
									direction: ltr;
									font-size: 0px;
									padding: 20px 0;
									text-align: center;
								"
							>
								<div
									class="mj-column-per-100 mj-outlook-group-fix"
									style="
										font-size: 0px;
										text-align: left;
										direction: ltr;
										display: inline-block;
										vertical-align: top;
										width: 100%;
									"
								>
									<table
										border="0"
										cellpadding="0"
										cellspacing="0"
										role="presentation"
										style="vertical-align: top"
										width="100%"
									>
										<tbody>
											<tr>
												<td
													align="center"
													style="
														font-size: 0px;
														padding: 10px 25px;
														word-break: break-word;
													"
												>
													<table
														border="0"
														cellpadding="0"
														cellspacing="0"
														role="presentation"
														style="
															border-collapse: collapse;
															border-spacing: 0px;
														"
													>
														<tbody>
															<tr>
																<td style="width: 100px">
																	<img
																		alt="Logo SMIL"
																		height="auto"
																		src="{{
																			url('email_template/logo_pnj.png')
																		}}"
																		style="
																			border: none;
																			display: block;
																			outline: none;
																			text-decoration: none;
																			height: auto;
																			width: 100%;
																			font-size: 13px;
																		"
																	/>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>

											<tr>
												<td
													align="center"
													style="
														font-size: 0px;
														padding: 10px 25px;
														word-break: break-word;
													"
												>
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

			<div
				style="
					background: #ffffff;
					background-color: #ffffff;
					margin: 0px auto;
					max-width: 600px;
				"
			>
				<table
					align="center"
					border="0"
					cellpadding="0"
					cellspacing="0"
					role="presentation"
					style="background: #ffffff; background-color: #ffffff; width: 100%"
				>
					<tbody>
						<tr>
							<td
								style="
									direction: ltr;
									font-size: 0px;
									padding: 20px 0;
									padding-bottom: 0px;
									padding-left: 0px;
									padding-top: 0px;
									text-align: center;
								"
							>
								<div
									class="mj-column-per-100 mj-outlook-group-fix"
									style="
										font-size: 0px;
										text-align: left;
										direction: ltr;
										display: inline-block;
										vertical-align: top;
										width: 100%;
									"
								>
									<table
										border="0"
										cellpadding="0"
										cellspacing="0"
										role="presentation"
										style="vertical-align: top"
										width="100%"
									>
										<tbody>
											<tr>
												<td
													align="left"
													style="
														font-size: 0px;
														padding: 10px 25px;
														padding-top: 50px;
														word-break: break-word;
													"
												>
													<div
														style="
															font-family: Arial;
															font-size: 14px;
															font-weight: bold;
															line-height: 1;
															text-align: left;
															color: #000000;
														"
													>
														Selamat, {{ $verifyEmail['verify_name'] }}
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div
									class="mj-column-per-100 mj-outlook-group-fix"
									style="
										font-size: 0px;
										text-align: left;
										direction: ltr;
										display: inline-block;
										vertical-align: top;
										width: 100%;
									"
								>
									<table
										border="0"
										cellpadding="0"
										cellspacing="0"
										role="presentation"
										style="vertical-align: top"
										width="100%"
									>
										<tbody>
											<tr>
												<td
													align="left"
													style="
														font-size: 0px;
														padding: 10px 25px;
														padding-top: 20px;
														word-break: break-word;
													"
												>
													<div
														style="
															font-family: Arial;
															font-size: 14px;
															line-height: 25px;
															text-align: left;
															color: #000000;
														"
													>
														Anda telah
														<span
															style="
																text-transform: uppercase;
																font-weight: bold;
															"
														>
															berhasil
														</span>
														terdaftar pada sistem ini sebagai
														<span
															style="
																text-transform: uppercase;
																font-weight: bold;
															"
														>
															{{ $verifyEmail['verify_roles'] }}
														</span>

														<br />
														Untuk menggunakan fitur yang tersedia pada sistem
														ini, silahkan lakukan verifikasi email anda melalui
														link dibawah ini
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div
									class="mj-column-per-100 mj-outlook-group-fix"
									style="
										font-size: 0px;
										text-align: left;
										direction: ltr;
										display: inline-block;
										vertical-align: middle;
										width: 100%;
									"
								>
									<table
										border="0"
										cellpadding="0"
										cellspacing="0"
										role="presentation"
										width="100%"
									>
										<tbody>
											<tr>
												<td
													style="
														vertical-align: middle;
														padding-top: 15px;
														padding-bottom: 15px;
													"
												>
													<table
														border="0"
														cellpadding="0"
														cellspacing="0"
														role="presentation"
														style=""
														width="100%"
													>
														<tbody>
															<tr>
																<td
																	align="left"
																	vertical-align="middle"
																	style="
																		font-size: 0px;
																		padding: 10px 25px;
																		word-break: break-word;
																	"
																>
																	<table
																		border="0"
																		cellpadding="0"
																		cellspacing="0"
																		role="presentation"
																		style="
																			border-collapse: separate;
																			line-height: 100%;
																		"
																	>
																		<tr>
																			<td
																				align="center"
																				bgcolor="#101939"
																				role="presentation"
																				style="
																					border: none;
																					border-radius: 4px;
																					cursor: auto;
																					mso-padding-alt: 10px 25px;
																					background: #101939;
																				"
																				valign="middle"
																			>
																				<a
																					style="
																						display: inline-block;
																						background: #101939;
																						color: #ffffff;
																						font-family: Assistant, Helvetica,
																							Arial, sans-serif;
																						font-size: 14px;
																						font-weight: normal;
																						line-height: 120%;
																						margin: 0;
																						text-decoration: none;
																						text-transform: none;
																						padding: 10px 25px;
																						mso-padding-alt: 0px;
																						border-radius: 4px;
																					"
																					href="{{
																						route(
																							'user-data.verify',
																							$verifyEmail['token']
																						)
																					}}"
																					target="_blank"
																				>
																					Verifikasi Email
																				</a>
																			</td>
																		</tr>
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
								<div
									class="mj-column-per-100 mj-outlook-group-fix"
									style="
										font-size: 0px;
										text-align: left;
										direction: ltr;
										display: inline-block;
										vertical-align: top;
										width: 100%;
									"
								>
									<table
										border="0"
										cellpadding="0"
										cellspacing="0"
										role="presentation"
										style="vertical-align: top"
										width="100%"
									>
										<tbody>
											<tr>
												<td
													align="left"
													style="
														font-size: 0px;
														padding: 10px 25px;
														padding-top: 40px;
														word-break: break-word;
													"
												>
													<div
														style="
															font-family: Arial;
															font-size: 14px;
															line-height: 1;
															text-align: left;
															color: #000000;
														"
													>
														Terima Kasih,
													</div>
												</td>
											</tr>

											<tr>
												<td
													align="left"
													style="
														font-size: 0px;
														padding: 5px 25px;
														padding-bottom: 52px;
														word-break: break-word;
													"
												>
													<div
														style="
															font-family: Arial;
															font-size: 14px;
															font-weight: bold;
															line-height: 1;
															text-align: left;
															color: #000000;
														"
													>
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
