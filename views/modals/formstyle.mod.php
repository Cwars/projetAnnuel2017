<form method="<?php echo $config["options"]["method"] ?>" enctype="multipart/form-data"
      action="<?php echo $config["options"]["action"] ?>"
      class="<?php echo $config["options"]["class"] ?>"
      id="<?php echo $config["options"]["id"] ?>">
    <?php foreach ($config["struct"] as $name => $attribute): ?>
        <?php if(
            $attribute['type'] == "email" ||
            $attribute['type'] == "password" ||
            $attribute['type'] == "text" ||
            $attribute['type'] == "file" ||
            $attribute['type'] == "date"
        ): ?>
            <input type="<?php echo $attribute["type"]; ?>"
                   name="<?php echo $name; ?>"
                   placeholder="<?php echo $attribute["placeholder"]; ?>"
                    <?php 
                    if($attribute["required"] === true){
                        echo "required";
                    }
                    ?>
            >
        <?php endif; ?>
        <?php if(
            $attribute['type'] == "select"
        ) : ?>
            <select name="<?php echo $attribute["optionName"] ?>"><?php foreach ($config["struct"]["Option"]["option"] as $name1 => $option):?>
                    <option class="<?php echo $option;?>" value="<?php echo $option;?>"><?php echo $option;?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <?php
        if (
            $attribute['type'] == "checkbox"
        ) :
            ?>
            <span class="checkbox-span">
                <input type="checkbox" id="<?php echo $attribute["name"] ?>"  name="<?php echo $attribute["name"] ?>" value="1" <?php if($attribute["required"] === true){echo "required";} ?> >
                <label for="<?php echo $attribute["name"] ?>"> <?php echo $attribute["label"] ?></label>
            </span>
        <?php endif; ?>
        <?php if(
            $attribute['type'] == "textarea"
        ) : ?>
            <textarea class="ckeditor" name="<?php echo $name ?>" placeholder="<?php echo $attribute["placeholder"]; ?>"
            <?php if($attribute["required"] === true){
                echo "required";
            }?>
            ></textarea>
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" value="Submit">
</form>