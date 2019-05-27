pub fn build_proverb(list: &[&str]) -> String {
    let num = list.len();
    if num == 0 {
        return String::new();
    }

    let mut result = Vec::<String>::with_capacity(num);
    for i in 1..num {
        result.push(format!(
            "For want of a {} the {} was lost.\n",
            list.get(i - 1).unwrap(),
            list.get(i).unwrap()
        ));
    }
    result.push(format!(
        "And all for the want of a {}.",
        list.first().unwrap()
    ));
    result.join("")
}
