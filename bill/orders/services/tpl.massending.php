<div class="b-layout b-layout_pad_10 b-layout_bord_e6 b-layout_relative b-layout_margbot_10 b-promo__servis b-promo__servis_let service" data-name="massending_<?= $service['id']?>" data-cost="<?= round($service['ammount'], 2)?>">
    <input type="hidden" name="opcode" value="<?= $service['op_code']; ?>" />
    <a href="javascript:void(0)" class="b-button b-button_admin_del b-button_float_right service-remove"></a>
    <h3 class="b-layout__h3 b-layout__h3_padleft_70">�������� �� �������� (<?= $service['info']['all_count'] . ending($service['info']['all_count'], ' ����������', ' ����������', ' �����������') ?>) &nbsp;&nbsp; <span class="b-layout__txt b-layout__txt_fontsize_11 b-layouyt__txt_weight_normal"><a href="/masssending/" class="b-layout__link">��������� �� ������</a></span></h3>
    <div class="b-layout__txt b-layout__txt_fontsize_11 b-layout__txt_padbot_20 b-layout__txt_padleft_70">� ����� ����������� ������: �������� �� �������� � ��� ����������� ��������� ����������. �� ������ ������������ ������� ��������� �� ����������� ��������� � �������� ������ ����������.</div>
    <div class="b-layout__txt b-layout__txt_padleft_70 b-layout__txt_fontsize_22 b-layout__txt_color_fd6c30"><?= to_money($service['ammount'], 2) ?> ���.</div>
</div>