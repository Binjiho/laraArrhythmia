@extends('general.layouts.general-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox knowledge-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">부정맥 진단 방법</h3>
            </div>
            <p>
                부정맥은 종류에 따라 항상 부정맥 상태가 유지되는 경우도 있지만 대부분의 경우 짧은 시간 동안 나타났다가 저절로 소실되는 경우가 더 많으므로 진료실에서 부정맥을 확인하지 못할 수도 있습니다. 이러한 경우 자신의 맥박을 스스로 측정해보는 것이 도움이 됩니다 . 요즘에는 맥박수를 측정해주는 스마트폰 애플리케이션도 출시가 되어 있어서 적절히 활용하면 도움을 받을 수 있습니다. 또한, 혈압을 측정할 때 맥박수가 자동으로 측정되는 자가 혈압계도 있습니다.
            </p>
            <div class="img-wrap text-center">
                <img src="/html/general/assets/image/sub/img_diagnosis_01.png" alt="올바른 맥박 측정부위">
				<div class="img-tit">
                    <span class="highlights">올바른 맥박 측정부위</span>
                </div>
            </div>
			<p>
				병원에서 하는 검사로는 먼저 심전도가 있습니다. 심전도는 심장의 전기적인 활동을 우리 몸의 피부에 부착한 전극을 통해서 기록하는 검사입니다. 심전도는 심장에서 전기 자극이 잘못 만들어지거나 잘못 전달되어서 생기는 부정맥을 정확하게 진단할 수 있게 해주며 부정맥뿐만 아니라 부정맥의 원인이 되는 심장질환도 진단할 수 있게 해줍니다. 따라서 부정맥 진단에 있어서 심전도는 가장 중요한 검사입니다 .
			</p>
			<div class="img-wrap text-center">
                <img src="/html/general/assets/image/sub/img_diagnosis_02.png" alt="동방결졀(정상 맥박이 만들어지는 곳), 우심방, 방실결절, 우심실, 좌심실, 좌심방. 조기 심방 수축 그래프. 조기 심실 수축 그래프">
				<div class="img-tit">
                    <span class="highlights">(위) 정상 심전도 (아래) 심방세동 심전도 <br>심전도의 예시</span>
                </div>
			</div>
			<div class="img-contents">
                <p>
                    환자가 진료실에 방문하였을 때 부정맥 현상이 심전도로 기록되는 경우도 있으나 앞서 언급한대로 내원 당시는 심전도가 정상인 경우가 많고 또한 내원 당시에는 별 증상이 없는 경우도 많습니다. 따라서 24시간 생활심전도, 즉, 홀터검사를 자주 시행하게 됩니다. 이는 휴대용 녹음기와 같이 생긴 심전도 기록 장치를 휴대하고 다니면서 24~48시간 동안 일상 활동 중에 일어나는 심장의 모든 전기적 활동을 기록하는 것입니다. 홀터는 기록 시간이 일반 심전도에 비해 길기 때문에 부정맥 발생 당시를 포착하여 부정맥을 진단할 수 있는 가능성이 매우 커집니다.
                </p>
                <div class="img-wrap">
                    <img src="/html/general/assets/image/sub/img_diagnosis_03.png" alt="24시간 심전도 (홀터)">
                    <div class="img-tit">
                        <span class="highlights">24시간 심전도 (홀터)</span>
                    </div>
                </div>
            </div><br>
			<div class="img-contents">
				<p>
                    드물게 발생하거나 자신이 잘 느끼지 못하는 부정맥을 찾아내 것은 어렵습니다. 이를 보완하는 방법이 홀터인데, 이 역시 24시간 동안만 기록할 수 있기 때문에, 이보다 드물게 발생하는 부정맥을 진단하는 데에는 한계가 있습니다. 이렇게 드물게 발생하는 부정맥을 진단하기 위해 이용되고 있는 것이, 사건기록심전도와 루프형 삽입형 기록기입니다.
					2024-05-06<br>
					사건기록심전도는 이벤트 기록기라고도 하며 심전도 전극과 같은 것 2개를 가슴에 붙이고 1~2주 동안 기계를 몸에 지니고 다니면서 두근거림 등의 증상이 생겼을 때, 기계에 있는 단추를 누르면, 그 순간의 맥박이 기록되는 것입니다. 상황에 따라 본인이 직접 전극을 떼고 붙이는 것이 간편하므로 큰 부담은 없습니다.
                </p>
                <div class="img-wrap">
                    <img src="/html/general/assets/image/sub/img_diagnosis_04.png" alt="사건기록심전도">
                    <div class="img-tit">
                        <span class="highlights">사건기록심전도</span>
                    </div>
                </div>				
            </div><br>
			<div class="img-contents">
				<p>
                    삽입형 루프 기록기는 가벼운 금속막대 모양입니다. 오랜 기간 심전도 기록을 가능하게 하기 위하여 피부 밑에 이식을 합니다. 가슴 부위의 피부를 약간 절개하고 무척 간단한 방법으로 이 기계를 피부 밑에 심어놓은 후 지속해서 환자의 맥박을 감시하고 기록하게 됩니다. 부정맥 의심 증상이 매우 드물게 발생하여 24시간 생활심전도나 사건기록심전도 같은 기존의 검사방법으로 진단되지 않을 때 사용합니다. 기구의 수명은 최장 3년 정도입니다. 두근거리는 증상이나 의식소실 등이 발생할 당시의 심전도를 확인하는 것이 가능하므로 부정맥의 진단에 큰 도움이 됩니다.
                </p>
                <div class="img-wrap">
                    <img src="/html/general/assets/image/sub/img_diagnosis_05.png" alt="삽입형 루프 기록기 [출처] Mayo clinic">
                    <div class="img-tit">
                        <span class="highlights">삽입형 루프 기록기 [출처] <a href="http://www.mayoclinic.org/" target="_blank">Mayo clinic</a></span>
                    </div>
                </div>				
            </div><br>
			<div class="img-contents">
				<p>
                    운동부하검사는 운동을 통해 심장에 부담을 주어 반응을 살피는 검사방법으로 주로 협심증의 진단에 사용됐습니다. 운동하게 되면 심장 박동이 빨라지고 혈압도 한때 상승하게 되어 심장에 부담이 늘어납니다. 부정맥 분야에서 운동부하검사는, 운동과 관련이 있는 부정맥을 진단하기 위한 목적으로 사용되며, 또한 이미 부정맥을 진단받은 환자에서 운동의 정도에 따라 부정맥이 악화하거나 유발되지는 않는가를 살펴볼 목적으로도 사용됩니다. 운동은 런닝머신처럼 생긴 기계나 자전거를 사용하며 운동의 정도를 점차 높여가며, 의료진이 옆에서 증상의 발현이나 혈압, 심장박동수의 변화, 심전도의 변화를 측정하게 됩니다. 환자가 허리나 다리가 아파 운동을 할 수 있는 상황이 아닌 경우에는 약물로 심장에 부담을 주는 방법을 사용하기도 합니다.
                </p>
                <div class="img-wrap">
                    <img src="/html/general/assets/image/sub/img_diagnosis_06.png" alt="운동부하검사">
                    <div class="img-tit">
                        <span class="highlights">운동부하검사</span>
                    </div>
                </div>				
            </div><br>
			<p>
				그리고 부정맥을 일으킬 수 있는 심장질환이 있는지를 알아보기 위하여 심초음파를 시행해 볼 수 있습니다. 초음파를 이용하여 심장의 크기, 구조, 움직임, 기능 등을 평가할 수 있는 아주 유용한 검사입니다. 심장질환을 진단하는데 있어서 기본적인 검사입니다. 보통의 경우는 가슴 부위에 초음파를 시행하여 심장을 검사하지만 경우에 따라서는 가슴 부위 초음파로 다 관찰할 수 없는 부위를 관찰해야 하는 경우에는 식도를 통해 시행하는 경식도 심초음파를 시행하기도 합니다. 경식도 심초음파는 위내시경을 하는 방법과 동일하며 비교적 안전하게 시행할 수 있습니다.
			</p	><br>
			<p>
				기립경 검사는 반복적인 실신을 경험하는 환자에서 시행할 수 있습니다. 검사 받는 분을 침대에 눕힌 후 60~80°로 세웠다 눕혔다를 반복하며 약물을 투여하면서 환자의 맥박과 혈압을 관찰하는 검사입니다. 미주신경성 실신 (vasovagal syncope) 을 가진 환자에서 혈압이 떨어지거나 맥박이 심하게 느려져서 실신이 유발될 수 있습니다.
			</p><br>
			<p>
				심장 전기생리검사는 부정맥의 종류와 발생 기전을 확실하게 규명해 주는 검사입니다. 직경 2 mm 정도의 가는 여러 개의 줄 (전극도자, electrode catheter) 을 정맥이나 동맥을 통해 심장 안에 넣으면 심장 내 전기의 활동과 흐름 등을 알 수 있어 심장 내 심전도를 얻을 수 있는 검사입니다. 보통의 경우는 입원이 필요하며 심전도나 24시간 심전도로 진단된 부정맥의 종류가 고주파 도자 절제술을 이용하여 완치할 수 있는 경우에 주로 시행하지만, 의사의 주의 깊은 병력청취로 부정맥이 강력히 의심되고 증상이 심하지만 여러 가지 검사에서 진단이 되지 않을 때도 시행할 수 있습니다.
			</p>
        </div>
    </article>
@endsection

@section('addScript')
@endsection