class Phrase
  def initialize(phrase)
    @phrase = phrase
  end

  def word_count
    @word_count ||= @phrase
      .downcase
      .scan(/[[\w']]+/)
      .map {|w| w.delete_prefix("'").delete_suffix("'") }
      .group_by(&:itself)
      .transform_values(&:count)
  end
end
