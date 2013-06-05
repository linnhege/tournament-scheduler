<div id="tournaments">
    <div class="post-heading">
        <h1>Turneringer</h1>
    </div>

    <div class="block full">
        <h3>Kommende turneringer <span class="arrows">»</span></h3>
        <table>
            <tr class="head">
                <td>Når</td>
                <td>Turnering</td>
            </tr>
        <?php foreach ($objects as $object): ?>
            <?php $exist = false; ?>
            <?php if ($object->date >= date("Y-m-d H:i:s")){ ?>
                <?php $exist = true; ?>
                <tr>
                    <?php $this->render_view('_item', array('locals' => array('tournament' => $object))); ?>
                </tr>
            <?php } ?>
        <?php endforeach; ?>
        <?php if ($exist == false){ ?>
            <td colspan="2">Det er ingen kommende turneringer.</td>
        <?php } ?>
        </table>
    </div>

    <div class="block full">
        <h3>Spilte turneringer <span class="arrows">»</span></h3>
        <table>
            <tr class="head">
                <td>Når</td>
                <td>Turnering</td>
            </tr>
            <?php foreach ($objects as $object): ?>
                <?php $exist = false; ?>
                <?php if ($object->date < date("Y-m-d H:i:s")){ ?>
                    <?php $exist = true; ?>
                    <tr>
                        <?php $this->render_view('_item', array('locals' => array('tournament' => $object))); ?>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>
            <?php if ($exist == false){ ?>
                <td colspan="2">Det er ingen tidligere turneringer.</td>
            <?php } ?>
        </table>
    </div>

    <?php echo $this->pagination(); ?>
</div>